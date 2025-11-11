<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doacao;
use App\Models\Doador;
use App\Models\Instituicao;
use App\Models\Campanha;

class DoacaoSeeder extends Seeder
{
    public function run()
    {
        // Busca o doador pelo email
        $doador = Doador::where('email', 'doador@gmail.com')->first();
        if (!$doador) {
            $doador = Doador::create([
                'nome' => 'Doador Teste',
                'cpf_cnpj' => '12345678901',
                'telefone' => '11988887777',
                'email' => 'doador@gmail.com',
                'senha' => bcrypt('senha123'),
                'tipo_doador' => 'Pessoa Física',
                'endereco' => 'Rua do Doador, 456',
                'cidade' => 'Cidade Doador',
                'estado' => 'SP',
                'cep' => '87654321',
            ]);
        }

        // Busca uma instituição e campanha para associar as doações
        $instituicao = Instituicao::first();
        $campanha = Campanha::first();

        // Cria doações teste
        Doacao::create([
            'tipo_doacao' => 'Dinheiro',
            'descricao' => 'Doação em dinheiro para campanha',
            'quantidade' => null,
            'valor' => 100.00,
            'data_doacao' => now()->subDays(2),
            'status' => 'ativa',
            'instituicao_id' => $instituicao ? $instituicao->id : null,
            'doador_id' => $doador->id,
        ]);
        Doacao::create([
            'tipo_doacao' => 'Alimento',
            'descricao' => 'Doação de 10 cestas básicas',
            'quantidade' => 10,
            'valor' => null,
            'data_doacao' => now()->subDays(5),
            'status' => 'ativa',
            'instituicao_id' => $instituicao ? $instituicao->id : null,
            'doador_id' => $doador->id,
        ]);
    }
}
