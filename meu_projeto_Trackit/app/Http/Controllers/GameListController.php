<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameList;
use Illuminate\Support\Facades\Auth;

class GameListController extends Controller
{
    public function store(Request $request)
    {
        GameList::firstOrCreate([
            'user_id' => Auth::id(),
            'game_title' => $request->game_title,
        ], [
            'image_url' => $request->image_url,
        ]);

        return redirect()->back()->with('success', 'Jogo adicionado à GameList!');
    }

    public function destroy($game_title)
    {
        $game = GameList::where('user_id', Auth::id())
            ->where('game_title', $game_title)
            ->firstOrFail();

        $game->delete();

        return redirect()->back()->with('success', 'Jogo removido da GameList!');
    }

    public function index()
    {
        $gamelist = GameList::where('user_id', Auth::id())->get();

        return view('gamelist.index', compact('gamelist'));
    }
}
