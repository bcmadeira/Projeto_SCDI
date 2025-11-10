<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function create()
    {
        $instituicoes = Instituicao::all();
        return view('Adm.criarCampanhas', compact('instituicoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio', // data_fim deve ser posterior
            'instituicao_id' => 'required|exists:instituicoes,id', // instituição precisa existir
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'data_inicio.required' => 'A data de início é obrigatória.',
            'data_fim.required' => 'A data de término é obrigatória.',
            'data_fim.after' => 'A data de término deve ser posterior à data de início.',
            'instituicao_id.required' => 'Selecione uma instituição.',
            'instituicao_id.exists' => 'A instituição selecionada é inválida.',
        ]);

        Campanha::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'instituicao_id' => $request->instituicao_id,
        ]);

        // mensagem de sucesso + instrução para redirecionar
        return redirect()
            ->back()
            ->with('success', 'Campanha criada com sucesso! Redirecionando...');
    }

    public function index()
    {
        $campanhas = Campanha::all();
        return view('Usuario.campanhas', compact('campanhas'));
    }

    public function show($id)
    {
        $campanha = Campanha::findOrFail($id);
        return view('Usuario.show', compact('campanha'));
    }
}
