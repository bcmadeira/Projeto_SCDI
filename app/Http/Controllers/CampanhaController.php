<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Campanha;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function create()
    {
        // Debug da sessão
        $userId = session('userId');
        $userType = session('userType');
        
    Log::info('Tentando criar campanha', [
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
    }

    public function store(Request $request)
    {
        $instituicaoId = session('userId');

        // TEMPORÁRIO: Se não tiver sessão, pega a primeira instituição
        if (!$instituicaoId) {
            $instituicaoId = \App\Models\Instituicao::first()->id ?? 1;
            Log::warning('Usando instituição temporária: ' . $instituicaoId);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'descricao' => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
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

    Log::info('Campanha criada com sucesso', ['campanha_id' => $campanha->id]);

        return redirect()->route('campanhas.minhas')->with('success', 'Campanha criada com sucesso!');
    }

    public function index()
    {
        $campanhas = \App\Models\Campanha::with('instituicao')->get();
        return view('campanhas.lista', compact('campanhas'));
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
            Log::warning('Sem sessão - mostrando todas as campanhas');
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
