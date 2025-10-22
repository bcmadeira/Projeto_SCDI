<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampanhaController extends Controller
{
    public function create()
    {
        return view('Adm.criarCampanhas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        Campanha::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'instituicao_id' => Auth::user()->instituicao_id,
        ]);

        return redirect()->back()->with('success', 'Campanha criada com sucesso!');
    }

    public function index()
    {
        $campanhas = \App\Models\Campanha::all();
        return view('Usuario.campanhas', compact('campanhas'));
    }

    public function show($id)
    {
        $campanha = Campanha::findOrFail($id);
        return view('Usuario.show', compact('campanha'));
    }
}
