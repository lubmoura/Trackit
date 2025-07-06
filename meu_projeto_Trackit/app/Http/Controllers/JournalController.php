<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Journal;
use App\Models\GameList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

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

        return view('journal.index', [
            'games' => $games,
            'gameListTitles' => $gameListTitles,
        ]);
    }
}
