<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Journal;
use App\Models\GameList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $perPage = 7;
        $urlsPaginator = Url::paginate($perPage);

        $journals = Journal::all()->keyBy('game_title');

        $gameListTitles = GameList::where('user_id', Auth::id())->pluck('game_title')->toArray();

        $gamesCollection = collect($urlsPaginator->items())->map(function ($url) use ($journals) {
            $titleRaw = pathinfo(parse_url($url->url, PHP_URL_PATH), PATHINFO_FILENAME);
            $title = ucwords(str_replace(['-', '_', ':'], ' ', $titleRaw));

            return [
                'id' => $journals[$title]->id ?? null,
                'title' => $title,
                'image' => $url->url,
                'story' => $journals[$title]->story ?? 'Unvailble Synopses',
            ];
        });


        $games = new LengthAwarePaginator(
            $gamesCollection,
            $urlsPaginator->total(),
            $perPage,
            $urlsPaginator->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('journals.index', [
            'games' => $games,
            'gameListTitles' => $gameListTitles,
        ]);
    }

    //parte pro adm pd editar e excluir  e criar
    public function create(Request $request)
    {
        $title = $request->get('title');
        $image = $request->get('image');

        return view('journals.create', compact('title', 'image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_title' => 'required|string|max:255',
            'image_url' => 'required|url',
            'story' => 'required|string',
        ]);

        Journal::create([
            'game_title' => $request->game_title,
            'image_url' => $request->image_url,
            'story' => $request->story,
        ]);

        return redirect()->route('journals.index')->with('success', 'História adicionada com sucesso!');
    }

    public function edit($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);

        $request->validate([
            'story' => 'required|string',
        ]);

        $journal->update([
            'story' => $request->story,
        ]);

        return redirect()->route('journals.index')->with('success', 'História atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'História excluída com sucesso!');
    }
}
