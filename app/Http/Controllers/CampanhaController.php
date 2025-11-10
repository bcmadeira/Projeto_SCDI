<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function create()
    {
<<<<<<< HEAD
        // Debug da sessão
        $userId = session('userId');
        $userType = session('userType');
        
        \Log::info('Tentando criar campanha', [
            'userId' => $userId,
            'userType' => $userType,
            'session_all' => session()->all()
        ]);

        // TEMPORÁRIO: Comentado para teste
        // Verificar se está logado como instituição
        // if (!$userId || $userType !== 'instituicao') {
        //     \Log::warning('Acesso negado - usuário não está logado como instituição');
        //     return redirect()->route('login')->with('error', 'Você precisa estar logado como instituição para criar campanhas');
        // }

        return view('instituicao.criar-campanha');
=======
        $instituicoes = Instituicao::all();
        return view('Adm.criarCampanhas', compact('instituicoes'));
>>>>>>> origin/main
    }

    public function store(Request $request)
    {
        $instituicaoId = session('userId');

        // TEMPORÁRIO: Se não tiver sessão, pega a primeira instituição
        if (!$instituicaoId) {
            $instituicaoId = \App\Models\Instituicao::first()->id ?? 1;
            \Log::warning('Usando instituição temporária: ' . $instituicaoId);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
<<<<<<< HEAD
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'meta_valor' => 'nullable|numeric|min:0',
            'categoria' => 'nullable|string|max:50',
        ]);

        $campanha = Campanha::create([
            'titulo' => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'data_inicio' => $validated['data_inicio'],
            'data_fim' => $validated['data_fim'],
            'meta_valor' => $validated['meta_valor'] ?? null,
            'categoria' => $validated['categoria'] ?? 'geral',
            'instituicao_id' => $instituicaoId,
            'status' => 'ativa',
        ]);

        \Log::info('Campanha criada com sucesso', ['campanha_id' => $campanha->id]);

        return redirect()->route('campanhas.minhas')->with('success', 'Campanha criada com sucesso!');
=======
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
>>>>>>> origin/main
    }

    public function index()
    {
<<<<<<< HEAD
        $campanhas = \App\Models\Campanha::with('instituicao')->get();
        return view('campanhas.lista', compact('campanhas'));
=======
        $campanhas = Campanha::all();
        return view('Usuario.campanhas', compact('campanhas'));
>>>>>>> origin/main
    }

    public function show($id)
    {
        $campanha = Campanha::with('instituicao')->findOrFail($id);
        return view('campanhas.detalhes', compact('campanha'));
    }

    /**
     * Exibir campanhas da instituição logada
     */
    public function minhas()
    {
        $instituicaoId = session('userId');
        
        // TEMPORÁRIO: Se não houver sessão, mostra todas as campanhas
        if (!$instituicaoId) {
            \Log::warning('Sem sessão - mostrando todas as campanhas');
            $campanhas = Campanha::with('instituicao')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $campanhas = Campanha::where('instituicao_id', $instituicaoId)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('instituicao.minhas-campanhas', compact('campanhas'));
    }
}
