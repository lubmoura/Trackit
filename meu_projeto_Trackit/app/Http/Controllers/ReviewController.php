<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Url;
use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create() {}

    public function show(string $id) {}


    public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id != Auth::id()) {
            abort(403, 'Ação não autorizada');
        }

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id != Auth::id()) {
            abort(403, 'Ação não autorizada');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review->update($request->only(['rating', 'comment']));

        return redirect()->route('reviews.game', ['game' => $review->game_title])->with('success', 'Review atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id != Auth::id()) {
            abort(403, 'Ação não autorizada');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review excluída com sucesso.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'game_title' => $request->game_title,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Review enviada com sucesso!');
    }

    public function showReviewForm($game)
    {
        $urls = Url::all();

        $that = $this;
        $gameData = $urls->map(function ($url) use ($that) {
            return [
                'title' => $that->extractTitleFromUrl($url->url),
                'image' => $url->url,
            ];
        })->firstWhere('title', $game);

        if (!$gameData) {
            abort(404);
        }

        $reviews = Review::where('game_title', $gameData['title'])->latest()->get();

        return view('reviews.form', compact('gameData', 'reviews'));
    }

//
  public function dashboard()
{
    $reviews = Review::paginate(3);

    $paginatedUrls = Url::paginate(8); 

    $that = $this; 

    $gameListTitles = GameList::where('user_id', Auth::id())->pluck('game_title')->toArray();

    $games = $paginatedUrls->map(function ($url) use ($that) {
        return [
            'title' => $that->extractTitleFromUrl($url->url),
            'image' => $url->url,
        ];

    });

    $userReviews = Review::where('user_id', Auth::id())
        ->get()
        ->mapWithKeys(function ($review) {
            return [trim($review->game_title) => $review];
        });

    $gamesWithReviews = $games->map(function ($game) use ($userReviews) {
        $title = trim($game['title']);
        $review = $userReviews->get($title);
        return [
            'title' => $game['title'],
            'image' => $game['image'],
            'review' => $review?->comment,
            'rating' => $review?->rating,
        ];
    });

    $favoritedTitles = Favorite::where('user_id', Auth::id())->pluck('game_title')->toArray();

   
    return view('dashboard', [
        'games' => $gamesWithReviews,
        'reviews' => $reviews,
        'paginatedUrls' => $paginatedUrls, 
        'favoritedTitles' => $favoritedTitles, 
        'gameListTitles' => $gameListTitles,
    ]);
}

//
private function extractTitleFromUrl($url)
{
    $filename = pathinfo($url, PATHINFO_FILENAME);
    $title = str_replace(['-', '_'], ' ', $filename);
    return ucwords(strtolower($title));
}


 }