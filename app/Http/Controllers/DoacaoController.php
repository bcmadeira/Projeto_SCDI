<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanha;
use App\Models\Instituicao;
use App\Models\Doador;
use App\Models\Doacao;
use Carbon\Carbon;

class DoacaoController extends Controller
{
    public function create($id)
    {
        $campanha = \App\Models\Campanha::findOrFail($id);
        $doadores = \App\Models\Doador::all();

        // Puxa automaticamente a instituição associada à campanha
        $instituicao = $campanha->instituicao;

        return view('Usuario.doar', compact('campanha', 'instituicao', 'doadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_doacao' => 'required|string|max:100',
            'valor' => 'nullable|numeric|min:0',
            'quantidade' => 'nullable|integer|min:1',
            'descricao' => 'nullable|string',
            'instituicao_id' => 'required|exists:instituicoes,id',
            'doador_id' => 'required|exists:doadores,id',
        ]);

        Doacao::create([
            'tipo_doacao' => $request->tipo_doacao,
            'descricao' => $request->descricao,
            'quantidade' => $request->quantidade,
            'valor' => $request->valor,
            'data_doacao' => Carbon::now(),
            'status' => 'ativa',
            'instituicao_id' => $request->instituicao_id,
            'doador_id' => $request->doador_id,
        ]);

        return redirect('/campanhas')->with('success', 'Doação realizada com sucesso!');
    }
}
