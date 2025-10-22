<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $campanhas = Campanha::all();
        return view('Usuario.campanhas', compact('campanhas'));
    }

    public function show($id)
    {
        $campanha = Campanha::findOrFail($id);
        return view('Usuario.show', compact('campanha'));
    }

    // ✅ Método do relatório
    public function relatorio($id)
    {
        // Busca a campanha com a instituição relacionada
        $campanhas = Campanha::with('instituicoes')->findOrFail($id);

        // Calcula diferença entre datas
        $inicio = Carbon::parse($campanhas->data_inicio);
        $fim = Carbon::parse($campanhas->data_fim);
        $tempoAcao = $inicio->diffInDays($fim);

        // Exemplo: dados fictícios do gráfico
        $dadosGrafico = [
            'Janeiro' => 1500,
            'Fevereiro' => 2300,
            'Março' => 1800,
        ];

        // Exemplo: total de doadores e status (aqui fixos, mas podem vir do BD)
        $totalDoadores = 25;
        $status = now()->between($inicio, $fim) ? 'Em andamento' : 'Finalizada';

        // Retorna a view passando todos os dados
        return view('Adm.relatorio', compact('campanhas', 'tempoAcao', 'dadosGrafico', 'totalDoadores', 'status'));
    }
}
