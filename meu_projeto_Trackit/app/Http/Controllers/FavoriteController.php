<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'game_title' => $request->game_title,
        ], [
            'image_url' => $request->image_url,
        ]);

        return redirect()->back()->with('success', 'Jogo favoritado!');
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }
}
