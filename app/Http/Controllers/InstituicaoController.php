<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
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
        // Validação dos campos
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'cnpj' => 'required|string|max:18',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:10',
            'descricao' => 'nullable|string|max:500',
            'senha' => 'required|string|min:3',
        ]);

        //  Salvando no banco
        $instituicao = Instituicao::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'cnpj' => $validated['cnpj'],
            'telefone' => $validated['telefone'],
            'endereco' => $validated['endereco'],
            'cidade' => $validated['cidade'],
            'estado' => $validated['estado'],
            'cep' => $validated['cep'],
            'descricao' => $validated['descricao'] ?? null,
            'senha' => bcrypt($validated['senha']),
            'tipo' => 'ong',
            'ramo' => 'geral', // Valor padrão
        ]);

        // Fazer login automático
        session(['userType' => 'instituicao', 'userEmail' => $instituicao->email, 'userId' => $instituicao->id]);
        
        return redirect()->route('dashboard.instituicao')->with('success', 'Cadastro realizado com sucesso! Bem-vindo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function show(Instituicao $instituicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Instituicao $instituicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instituicao $instituicao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instituicao $instituicao)
    {
        //
    }

    /**
     * Process login request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Validação simples (temporária - substitua por autenticação real)
        if ($email === 'instituicao@gmail.com' && $password === '123') {
            // Login como instituição
            session(['userType' => 'instituicao', 'userEmail' => $email]);
            return redirect()->route('dashboard.instituicao');
        } elseif ($email === 'doador@gmail.com' && $password === '123') {
            // Login como doador
            session(['userType' => 'doador', 'userEmail' => $email]);
            return redirect()->route('dashboard.doador');
        } else {
            return redirect()->back()->withErrors(['error' => 'Email ou senha incorretos!']);
        }
    }

    /**
     * Exibir perfil da instituição
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil()
    {
        // TEMPORÁRIO: Buscar instituição logada ou usar a primeira se sessão não existir
        $userId = session('userId');
        
        if (!$userId) {
            // Se não houver sessão, usar a primeira instituição (temporário para testes)
            $instituicao = Instituicao::first();
        } else {
            $instituicao = Instituicao::find($userId);
        }

        if (!$instituicao) {
            return redirect()->route('login')->with('error', 'Usuário não encontrado');
        }

        return view('instituicao.perfil', compact('instituicao'));
    }

    /**
     * Exibir dashboard da instituição com dados reais
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // TEMPORÁRIO: Buscar instituição logada ou usar a primeira se sessão não existir
        $userId = session('userId');
        
        if (!$userId) {
            $instituicao = \App\Models\Instituicao::first();
            $instituicaoId = $instituicao ? $instituicao->id : null;
        } else {
            $instituicaoId = $userId;
        }

        // Buscar campanhas da instituição
        $campanhas = \App\Models\Campanha::where('instituicao_id', $instituicaoId)->get();

        // Total de doações recebidas pela instituição (doações tem instituicao_id diretamente)
        $totalDoacoes = \App\Models\Doacao::where('instituicao_id', $instituicaoId)->count();

        // Total de doadores únicos
        $totalDoadores = \App\Models\Doacao::where('instituicao_id', $instituicaoId)
            ->distinct('doador_id')
            ->count('doador_id');

        // Campanhas ativas (data_fim > hoje)
        $campanhasAtivas = $campanhas->filter(function($campanha) {
            return \Carbon\Carbon::parse($campanha->data_fim) > now();
        })->count();

        // Valor total arrecadado
        $valorTotal = \App\Models\Doacao::where('instituicao_id', $instituicaoId)->sum('valor');
        $valorArrecadado = 'R$ ' . number_format($valorTotal / 1000, 1, ',', '.') . 'k';

        // Buscar últimas 5 doações com informações do doador
        $atividadesRecentes = \App\Models\Doacao::where('instituicao_id', $instituicaoId)
            ->with('doador')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Buscar dados para gráfico de categorias (distribuição por tipo de doação)
        $distribuicaoCategorias = \App\Models\Doacao::where('instituicao_id', $instituicaoId)
            ->selectRaw('tipo_doacao, SUM(valor) as total')
            ->groupBy('tipo_doacao')
            ->get();

        // Buscar dados mensais para o gráfico de linha (Jan a Dez do ano atual)
        $dadosMensais = [];
        $mesesLabels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        
        for ($mes = 1; $mes <= 12; $mes++) {
            $totalMes = \App\Models\Doacao::where('instituicao_id', $instituicaoId)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $mes)
                ->sum('valor');
            
            $dadosMensais[] = $totalMes ? floatval($totalMes) : 0;
        }

        return view('dashboard.instituicao', compact(
            'totalDoacoes',
            'totalDoadores',
            'campanhasAtivas',
            'valorArrecadado',
            'atividadesRecentes',
            'distribuicaoCategorias',
            'dadosMensais',
            'mesesLabels'
        ));
    }
}
