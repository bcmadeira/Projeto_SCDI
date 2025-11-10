<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanha;
use App\Models\Instituicao;
use App\Models\Doador;
use App\Models\Doacao;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DoacaoController extends Controller
{
    public function create($campanha_id)
    {
        $campanha = Campanha::findOrFail($campanha_id);
        $instituicao = $campanha->instituicao;
        $doadorLogado = Auth::guard('doador')->user(); // pega o doador autenticado

        return view('usuario.doar', compact('campanha', 'instituicao', 'doadorLogado'));
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

    /**
     * Display the donations of the logged in donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function minhas()
    {
        // Buscar doações do banco de dados com relacionamentos
        $doacoes = \App\Models\Doacao::with(['campanha.instituicao'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('doador.minhas-doacoes', compact('doacoes'));
    }
}
