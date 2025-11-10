<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campanha;
use App\Models\Doacao;
use App\Models\Doador;
use App\Models\Instituicao;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    /**
     * Exibe todas as campanhas com filtro opcional.
     */
    public function index()
    {
        $campanhas = Campanha::with(['instituicao', 'doacoes.doador'])->get();
        $instituicoes = Instituicao::all(); // Para filtros no front-end

        return view('Adm.relatorio.index', compact('campanhas', 'instituicoes'));
    }

    /**
     * Mostra os detalhes de uma campanha específica.
     */
    public function show($id)
    {
        $campanha = Campanha::with(['instituicao', 'doacoes.doador'])->findOrFail($id);
        $dadosRelatorio = $this->gerarDadosRelatorio($campanha);

        return view('Adm.relatorio.show', compact('campanha', 'dadosRelatorio'));
    }

    /**
     * Filtra campanhas por data e instituição.
     */
    public function filtrar(Request $request)
    {
        $query = Campanha::with(['instituicao', 'doacoes.doador']);

        if ($request->filled('data_inicio')) {
            $query->where('data_inicio', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->where('data_fim', '<=', $request->data_fim);
        }

        if ($request->filled('instituicao_id')) {
            $query->where('instituicao_id', $request->instituicao_id);
        }

        $campanhas = $query->get();
        $instituicoes = Instituicao::all();

        return view('Adm.relatorio.index', compact('campanhas', 'instituicoes'));
    }

    /**
     * Gera os dados numéricos do relatório.
     */
    public function gerarDadosRelatorio($campanha)
    {
        $totalArrecadado = $campanha->doacoes->sum('valor');
        $quantidadeDoacoes = $campanha->doacoes->count();
        $quantidadeDoadores = $campanha->doacoes->groupBy('doador_id')->count();

        $dataInicio = Carbon::parse($campanha->data_inicio);
        $dataFim = Carbon::parse($campanha->data_fim);
        $diasDuracao = $dataInicio->diffInDays($dataFim);

        return [
            'total_arrecadado'    => $totalArrecadado,
            'quantidade_doacoes'  => $quantidadeDoacoes,
            'quantidade_doadores' => $quantidadeDoadores,
            'dias_duracao'        => $diasDuracao,
            'media_diaria'        => $diasDuracao > 0 ? $totalArrecadado / $diasDuracao : 0,
        ];
    }

    /**
     * Exporta relatório em PDF (por enquanto retorna view de impressão).
     */
    public function exportarPdf($id)
    {
        $campanha = Campanha::with(['instituicao', 'doacoes.doador'])->findOrFail($id);
        $dadosRelatorio = $this->gerarDadosRelatorio($campanha);

        return view('Adm.relatorio.pdf', compact('campanha', 'dadosRelatorio'));
    }
}
