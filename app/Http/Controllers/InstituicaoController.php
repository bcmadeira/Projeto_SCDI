<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Lista todas as instituições
     */
    public function index()
    {
        $instituicoes = Instituicao::all();
        return view('instituicoes.index', compact('instituicoes'));
    }

    /**
     * Exibe o formulário de criação
     */
    public function create()
    {
        return view('instituicoes.create');
    }

    /**
     * Salva uma nova instituição no banco
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

        // Endereço formatado
        $endereco = "{$validated['rua']}" .
                    (!empty($validated['numero']) ? ", {$validated['numero']}" : "") .
                    (!empty($validated['complemento']) ? " - {$validated['complemento']}" : "");

        // Localização formatada
        $localizacao = "{$validated['cidade']} - CEP: {$validated['cep']}";

        // Salvar
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

        // Redireciona para a lista
        return redirect()->route('instituicoes.index')->with('success', 'Instituição cadastrada com sucesso!');
    }

    /**
     * Remove uma instituição
     */
    public function destroy(Instituicao $instituicao)
    {
        $instituicao->delete();
        return redirect()->route('instituicoes.index')->with('success', 'Instituição excluída com sucesso!');
    }
}
