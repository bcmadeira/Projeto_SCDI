<?php

namespace App\Http\Controllers;

use App\Models\Doador;
use App\Models\Doacao;
use Illuminate\Http\Request;

class DoadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:doadores,email',
            'cpf' => 'required|string|max:14',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:200',
            'cidade' => 'required|string|max:100',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:9',
            'senha' => 'required|string|min:3',
        ]);

        // Criar doador
        $doador = Doador::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'cpf_cnpj' => $validated['cpf'],
            'telefone' => $validated['telefone'],
            'tipo_doador' => 'pessoa_fisica', // Valor padrão
            'endereco' => $validated['endereco'],
            'cidade' => $validated['cidade'],
            'estado' => $validated['estado'] ?? null,
            'cep' => $validated['cep'] ?? null,
            'senha' => bcrypt($validated['senha']),
        ]);

        // Fazer login automático
        session(['userType' => 'doador', 'userEmail' => $doador->email, 'userId' => $doador->id]);

        // Redirecionar para dashboard do doador
        return redirect()->route('dashboard.doador')->with('success', 'Cadastro realizado com sucesso! Bem-vindo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doador  $doador
     * @return \Illuminate\Http\Response
     */
    public function show(Doador $doador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doador  $doador
     * @return \Illuminate\Http\Response
     */
    public function edit(Doador $doador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doador  $doador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doador $doador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doador  $doador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doador $doador)
    {
        //
    }

    /**
     * Display the doador dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Buscar campanhas em destaque (últimas 3)
        $campanhasDestaque = \App\Models\Campanha::with('instituicao')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Buscar dados do doador logado (temporário - usar Auth depois)
        $totalDoacoes = \App\Models\Doacao::count();
        $campanhasApoiadas = \App\Models\Doacao::distinct()->count('id'); // Corrigido
        $totalDoado = \App\Models\Doacao::sum('valor');
        $instituicoesAjudadas = \App\Models\Instituicao::count();

        return view('dashboard.doador', compact(
            'campanhasDestaque',
            'totalDoacoes',
            'campanhasApoiadas',
            'totalDoado',
            'instituicoesAjudadas'
        ));
    }

    /**
     * Exibir perfil do doador
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil()
    {
        // TEMPORÁRIO: Buscar doador logado ou usar o primeiro se sessão não existir
        $userId = session('userId');
        
        if (!$userId) {
            // Se não houver sessão, usar o primeiro doador (temporário para testes)
            $doador = Doador::first();
        } else {
            $doador = Doador::find($userId);
        }

        if (!$doador) {
            return redirect()->route('login')->with('error', 'Usuário não encontrado');
        }

        // Buscar estatísticas
        $totalDoacoes = Doacao::where('doador_id', $doador->id)->count();
        $totalDoado = Doacao::where('doador_id', $doador->id)->sum('valor');
        $instituicoesAjudadas = Doacao::where('doador_id', $doador->id)
            ->distinct('instituicao_id')
            ->count('instituicao_id');

        return view('doador.perfil', compact(
            'doador',
            'totalDoacoes',
            'totalDoado',
            'instituicoesAjudadas'
        ));
    }
}
