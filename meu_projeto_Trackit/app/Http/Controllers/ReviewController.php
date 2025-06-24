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
        ['title' => 'The last of us Part II', 'image' => 'https://i.ibb.co/KjyPvkhN/The-Last-Of-Us-part-2.jpg'],
        ['title' => 'Zelda: BOTW', 'image' => 'https://i.ibb.co/wxL3YFc/download.jpg'],
        ['title' => 'GTA: V', 'image' => 'https://i.ibb.co/DD0Z6b82/download-1.jpg'],
        ['title' => 'The Sims 4', 'image' => 'https://i.ibb.co/ZRP02KSG/download-2.jpg'],
        ['title' => 'Life is Strange', 'image' => 'https://i.ibb.co/Pz6Ft0BK/download-3.jpg'],
        ['title' => 'Skyrim', 'image' => 'https://i.ibb.co/35vctLBw/download-4.jpg'],
        ['title' => 'Firewatch', 'image' => 'https://i.ibb.co/Y73cTsgX/download-5.jpg'],
        ['title' => 'Stray', 'image' => 'https://i.ibb.co/6RH21vp3/download-6.jpg'],
        ['title' => 'Red Dead Redemption 2', 'image' => 'https://i.ibb.co/B5rZWyg9/download-7.jpg'],
        ['title' => 'Hollow Knight', 'image' => 'https://i.ibb.co/v64zmwTR/download-8.jpg'],

    
    ];

 
    $gameData = collect($games)->firstWhere('title', $game);

    
    if (!$gameData) {
        abort(404);
    }

  
    $reviews = Review::where('game_title', $gameData['title'])->latest()->get();

    return view('reviews.form', compact('gameData', 'reviews'));
}

    public function dashboard()
    {
        $games = [
            ['title' => 'The last of us Part II', 'image' => 'https://i.ibb.co/KjyPvkhN/The-Last-Of-Us-part-2.jpg'],
            ['title' => 'Zelda: BOTW', 'image' => 'https://i.ibb.co/wxL3YFc/download.jpg'],
            ['title' => 'GTA V', 'image' => 'https://i.ibb.co/DD0Z6b82/download-1.jpg'],
            ['title' => 'The Sims 4', 'image' => 'https://i.ibb.co/ZRP02KSG/download-2.jpg'],
            ['title' => 'Life is Strange', 'image' => 'https://i.ibb.co/Pz6Ft0BK/download-3.jpg'],
            ['title' => 'Skyrim', 'image' => 'https://i.ibb.co/35vctLBw/download-4.jpg'],
            ['title' => 'Firewatch', 'image' => 'https://i.ibb.co/Y73cTsgX/download-5.jpg'],
            ['title' => 'Stray', 'image' => 'https://i.ibb.co/6RH21vp3/download-6.jpg'],
            ['title' => 'Red Dead Redemption 2', 'image' => 'https://i.ibb.co/B5rZWyg9/download-7.jpg'],
            ['title' => 'Hollow Knight', 'image' => 'https://i.ibb.co/v64zmwTR/download-8.jpg'],

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
