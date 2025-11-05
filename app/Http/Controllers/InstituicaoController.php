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
            'telefone' => 'nullable|string|max:20',
            'telefone2' => 'nullable|string|max:20',
            'cpf' => 'nullable|string|max:14',
            'descricao' => 'nullable|string|max:500',
            'cnpj' => 'required|string|max:14',
            'ramo' => 'required|string|max:100',
            'cep' => 'required|string|max:8',
            'rua' => 'required|string|max:150',
            'numero' => 'nullable|string|max:20',
            'cidade' => 'required|string|max:100',
            'complemento' => 'nullable|string|max:100',
            'emailInstituicao' => 'required|email|max:100',
        ]);

        //  Cria um endereço completo usando valores de rua, numero e complemento
        $endereco = "{$validated['rua']}, {$validated['numero']} - {$validated['complemento']}";

        // Cria uma localização em base dos valores cidade e cep
        $localizacao = "{$validated['cidade']} - CEP: {$validated['cep']}";

        //  Salvando no banco
        Instituicao::create([
            'nome' => $validated['nome'],
            'cnpj' => $validated['cnpj'],
            'ramo' => $validated['ramo'],
            'telefone' => $validated['telefone'] ?? null,
            'telefone2' => $validated['telefone2'] ?? null,
            'localizacao' => $localizacao,
            'endereco' => $endereco,
            'cidade' => $validated['cidade'],
            'cep' => $validated['cep'],
            'email' => $validated['emailInstituicao'],
            'descricao' => $validated['descricao'] ?? null,
        ]);

        
        return redirect()->back()->with('success', 'Instituição cadastrada com sucesso!');
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
}
