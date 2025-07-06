<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function edit($id)
    {
        $url = Url::findOrFail($id);
        return view('admin.edit-url', compact('url'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url|max:255',
        ]);

        $url = Url::findOrFail($id);
        $url->update(['url' => $request->url]);

        return redirect()->route('dashboard')->with('success', 'Jogo atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $url = Url::findOrFail($id);
        $url->delete();

        return redirect()->route('dashboard')->with('success', 'Jogo removido com sucesso.');
    }
}
