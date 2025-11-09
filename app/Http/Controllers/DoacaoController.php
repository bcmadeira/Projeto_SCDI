<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use App\Models\Campanha;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class DoacaoController extends Controller
{
    public function create($id)
    {
        $campanha = Campanha::findOrFail($id);
        $instituicao = $campanha->instituicao;
        return view('Usuario.doar', compact('campanha', 'instituicao'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_doacao' => 'required|string|max:100',
            'valor' => 'nullable|numeric|min:0',
            'quantidade' => 'nullable|integer|min:1',
            'descricao' => 'nullable|string|max:500',
            'instituicao_id' => 'required|exists:instituicoes,id',
            'campanha_id' => 'nullable|exists:campanhas,id'
        ]);

        // Por enquanto, o doador será nulo (até ter login)
        Doacao::create([
            'tipo_doacao' => $request->tipo_doacao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
            'descricao' => $request->descricao,
            'data_doacao' => now(),
            'status' => 'ativa',
            'instituicao_id' => $request->instituicao_id,
            'doador_id' => null,
        ]);

        return redirect()
            ->route('campanhas.index')
            ->with('success', 'Doação registrada com sucesso!');
    }
}
