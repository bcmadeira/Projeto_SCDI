<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campanha;
use App\Models\Instituicao;

class CampanhaSeeder extends Seeder
{
    public function run()
    {
        // Busca a instituição pelo email
        $instituicao = Instituicao::where('email', 'insituicao@gmail.com')->first();
        if (!$instituicao) {
            // Cria a instituição caso não exista
            $instituicao = Instituicao::create([
                'nome' => 'Instituição Teste',
                'cnpj' => '12345678000199',
                'ramo' => 'Educação',
                'telefone' => '11999999999',
                'endereco' => 'Rua Teste, 123',
                'cidade' => 'Cidade Teste',
                'estado' => 'SP',
                'cep' => '12345678',
                'email' => 'insituicao@gmail.com',
                'descricao' => 'Instituição criada para testes.'
            ]);
        }

        // Cria campanhas teste
        Campanha::create([
            'titulo' => 'Campanha de Natal',
            'descricao' => 'Campanha para arrecadação de brinquedos.',
            'data_inicio' => now()->subDays(10),
            'data_fim' => now()->addDays(20),
            'instituicao_id' => $instituicao->id
        ]);
        Campanha::create([
            'titulo' => 'Campanha de Inverno',
            'descricao' => 'Campanha para arrecadação de agasalhos.',
            'data_inicio' => now()->subDays(30),
            'data_fim' => now()->addDays(10),
            'instituicao_id' => $instituicao->id
        ]);
    }
}
