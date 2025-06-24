<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        //
    }

    public function show(string $id)
    {
        //
    }

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
        $games = [
            'Ellie Cat' => ['title' => 'Ellie Cat', 'image' => 'https://i.ibb.co/Z6hbvpXb/Ellie-cat.jpg'],
            'Zelda: BOTW' => ['title' => 'Zelda: BOTW', 'image' => 'https://images7.alphacoders.com/125/thumb-1920-1251235.jpg'],
            'GTA: V' => ['title' => 'GTA: V', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202010/2217/rpD7MLaKY7rGToRMdTt1uEGP.png'],
        ];

        if (!isset($games[$game])) {
            abort(404);
        }

        $gameData = $games[$game];
        $reviews = Review::where('game_title', $gameData['title'])->latest()->get();

        return view('reviews.form', compact('gameData', 'reviews'));
    }

    public function dashboard()
    {
        $games = [
            ['title' => 'Ellie Cat', 'image' => 'https://i.ibb.co/Z6hbvpXb/Ellie-cat.jpg'],
            ['title' => 'Zelda: BOTW', 'image' => 'https://images7.alphacoders.com/125/thumb-1920-1251235.jpg'],
            ['title' => 'GTA V', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202010/2217/rpD7MLaKY7rGToRMdTt1uEGP.png'],
            ['title' => 'The Sims 4', 'image' => 'https://upload.wikimedia.org/wikipedia/en/5/5e/The_Sims_4_cover_art.jpg'],
            ['title' => 'Life is Strange', 'image' => 'https://cdn.akamai.steamstatic.com/steam/apps/319630/capsule_616x353.jpg'],
            ['title' => 'Skyrim', 'image' => 'https://wallpapercave.com/wp/wp2033438.jpg'],
            ['title' => 'Firewatch', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/383870/header.jpg'],
            ['title' => 'Stray', 'image' => 'https://cdn1.epicgames.com/offer/a5c786b9b84b4ec9b35a1bc78f4a8d59/EGS_Stray_BlueTwelveStudio_S2_1200x1600-8352f2156bfe91c0410a36e2dfdb948c'],
        ];

        $userReviews = Review::where('user_id', Auth::id())
            ->get()
            ->mapWithKeys(function ($review) {
                return [trim($review->game_title) => $review];
            });

        $gamesWithReviews = array_map(function ($game) use ($userReviews) {
            $title = trim($game['title']);

            $review = $userReviews->has($title) ? $userReviews->get($title) : null;
            return [
                'title' => $game['title'],
                'image' => $game['image'],
                'review' => $review ? $review->comment : null,
                'rating' => $review ? $review->rating : null,
            ];
        }, $games);

        return view('dashboard', ['games' => $gamesWithReviews]);
    }
}
