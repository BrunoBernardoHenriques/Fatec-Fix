<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('chamados.header')
    <h1>Dashboard</h1>

    <form method="GET" action="{{ route('dashboard') }}">
        <label for="month">Mês:</label>
        <select name="month" id="month">
            <option value="">Todos</option>
            @for($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ $m }}</option>
            @endfor
        </select>

        <label for="year">Ano:</label>
        <select name="year" id="year">
            <option value="">Todos</option>
            @for($y = date('Y'); $y >= 2000; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>

        <button type="submit">Filtrar</button>
    </form>

    @if($noRecordsFound)
        <p>Não foram encontrados registros para o filtro selecionado.</p>
    @else
        <h2>Tipos de Chamados</h2>
        <canvas id="tipoChamadosChart"></canvas>

        <h2>Lugares dos Chamados</h2>
        <canvas id="lugaresChamadosChart"></canvas>

        <h2>Status do Chamado</h2>
        <canvas id="statusChamadosChart"></canvas>

        <script>
            const tipoChamadosData = @json($tipoChamados);
            const lugaresChamadosData = @json($lugaresChamados);
            const statusChamadosData = @json($statusChamados);

            // Configurar gráfico de tipos de chamados
            new Chart(document.getElementById('tipoChamadosChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(tipoChamadosData),
                    datasets: [{
                        data: Object.values(tipoChamadosData),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    }]
                }
            });

            // Configurar gráfico de lugares de chamados
            new Chart(document.getElementById('lugaresChamadosChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(lugaresChamadosData),
                    datasets: [{
                        data: Object.values(lugaresChamadosData),
                        backgroundColor: ['#4BC0C0', '#FF6384', '#36A2EB'],
                    }]
                }
            });

            // Configurar gráfico de status de chamados
            new Chart(document.getElementById('statusChamadosChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(statusChamadosData),
                    datasets: [{
                        data: Object.values(statusChamadosData),
                        backgroundColor: ['#FFCE56', '#FF6384', '#36A2EB'],
                    }]
                }
            });
        </script>
    @endif
</body>
</html>
