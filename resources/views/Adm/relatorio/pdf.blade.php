<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório - {{ $campanha->titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #0d6efd;
            margin: 5px 0;
        }
        .header h2 {
            color: #666;
            margin: 5px 0;
            font-size: 18px;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-section h3 {
            background-color: #0d6efd;
            color: white;
            padding: 8px 15px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #0d6efd;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        .stat-card {
            border: 2px solid #0d6efd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
        .stat-card h4 {
            margin: 0 0 10px 0;
            color: #0d6efd;
            font-size: 14px;
        }
        .stat-card p {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        @media print {
            body {
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISTEMA DE CONTROLE DE DOAÇÕES INSTITUCIONAL</h1>
        <h2>Relatório de Campanha</h2>
        <p><strong>{{ $campanha->titulo }}</strong></p>
        <p>{{ $campanha->instituicao->nome }}</p>
    </div>

    <div class="info-section">
        <h3>Informações da Campanha</h3>
        <table>
            <tr>
                <th width="30%">ID da Campanha</th>
                <td>{{ $campanha->id }}</td>
            </tr>
            <tr>
                <th>Instituição</th>
                <td>{{ $campanha->instituicao->nome }}</td>
            </tr>
            <tr>
                <th>Categoria</th>
                <td>{{ ucfirst($campanha->categoria ?? 'geral') }}</td>
            </tr>
            <tr>
                <th>Data de Início</th>
                <td>{{ \Carbon\Carbon::parse($campanha->data_inicio)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Data de Término</th>
                <td>{{ \Carbon\Carbon::parse($campanha->data_fim)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Duração</th>
                <td>{{ $dadosRelatorio['dias_duracao'] }} dias</td>
            </tr>
            <tr>
                <th>Meta</th>
                <td>R$ {{ number_format($campanha->meta_valor ?? 0, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if(\Carbon\Carbon::parse($campanha->data_fim) > now())
                        Ativa
                    @else
                        Finalizada
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Descrição</h3>
        <p style="padding: 15px; background-color: #f8f9fa; border-left: 4px solid #0d6efd;">
            {{ $campanha->descricao }}
        </p>
    </div>

    <div class="info-section">
        <h3>Estatísticas</h3>
        <div class="stats-grid">
            <div class="stat-card">
                <h4>Total Arrecadado</h4>
                <p style="color: #198754;">R$ {{ number_format($dadosRelatorio['total_arrecadado'], 2, ',', '.') }}</p>
            </div>
            <div class="stat-card">
                <h4>Total de Doações</h4>
                <p style="color: #0d6efd;">{{ $dadosRelatorio['quantidade_doacoes'] }}</p>
            </div>
            <div class="stat-card">
                <h4>Doadores Únicos</h4>
                <p style="color: #0dcaf0;">{{ $dadosRelatorio['quantidade_doadores'] }}</p>
            </div>
            <div class="stat-card">
                <h4>Média Diária</h4>
                <p style="color: #ffc107;">R$ {{ number_format($dadosRelatorio['media_diaria'], 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    @if($campanha->doacoes->count() > 0)
        <div class="info-section">
            <h3>Histórico de Doações</h3>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Doador</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campanha->doacoes as $doacao)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($doacao->created_at)->format('d/m/Y H:i') }}</td>
                            <td>{{ $doacao->doador->nome }}</td>
                            <td style="color: #198754; font-weight: bold;">R$ {{ number_format($doacao->valor, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($doacao->tipo ?? 'monetária') }}</td>
                        </tr>
                    @endforeach>
                </tbody>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>Relatório gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>Sistema de Controle de Doações Institucional - SCDI</p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 30px; background-color: #0d6efd; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            🖨️ Imprimir / Salvar como PDF
        </button>
        <button onclick="window.history.back()" style="padding: 10px 30px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-left: 10px;">
            ❌ Voltar
        </button>
    </div>
</body>
</html>
