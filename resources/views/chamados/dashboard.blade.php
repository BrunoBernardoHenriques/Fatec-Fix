<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/chamados/dashboard.css">
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
        <div class="chart-container">
            <div class="chart-item">
                <h2>Tipos de Chamados</h2>
                <canvas id="tipoChamadosChart"></canvas>
            </div>

            <div class="chart-item">
                <h2>Lugares dos Chamados</h2>
                <canvas id="lugaresChamadosChart"></canvas>
            </div>

            <div class="chart-item">
                <h2>Status do Chamado</h2>
                <canvas id="statusChamadosChart"></canvas>
            </div>
        </div>

        <script>
            // Função para gerar cores únicas
            function generateColors(num) {
                const colors = [];
                for (let i = 0; i < num; i++) {
                    const color = `hsl(${(i * 137.508) % 360}, 70%, 50%)`; 
                    colors.push(color);
                }
                return colors;
            }

            const tipoChamadosData = @json($tipoChamados);
            const lugaresChamadosData = @json($lugaresChamados);
            const statusChamadosData = @json($statusChamados);

            // Função para ordenar os dados de forma decrescente
            function sortData(data) {
                const sortedData = Object.entries(data)
                    .sort((a, b) => b[1] - a[1]);  // Ordena de maior para menor
                return {
                    labels: sortedData.map(item => `${item[0]} (${item[1]})`),  // Formata os rótulos
                    values: sortedData.map(item => item[1])  // Obtém os valores ordenados
                };
            }

            // Função para obter os 10 primeiros registros para a legenda
            function getTop10ForLegend(data) {
                const sortedData = Object.entries(data)
                    .sort((a, b) => b[1] - a[1])
                    .slice(0, 10);  // Limita a 10 primeiros para a legenda

                return {
                    labels: sortedData.map(item => `${item[0]} (${item[1]})`),
                    values: sortedData.map(item => item[1])
                };
            }

            // Ordenar e configurar gráfico de tipos de chamados
            const sortedTipoChamados = sortData(tipoChamadosData);
            new Chart(document.getElementById('tipoChamadosChart'), {
                type: 'pie',
                data: {
                    labels: sortedTipoChamados.labels,
                    datasets: [{
                        data: sortedTipoChamados.values,
                        backgroundColor: generateColors(sortedTipoChamados.labels.length),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let label = tooltipItem.label || '';
                                    let value = tooltipItem.raw || 0;
                                    return `${label} (${value})`; 
                                }
                            }
                        },
                        legend: {
                            position: 'right', 
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                boxWidth: 12
                            }
                        }
                    }
                }
            });

            // Ordenar e configurar gráfico de lugares de chamados (com todos os dados no gráfico, mas legenda com os 10 mais)
            const sortedLugaresChamados = sortData(lugaresChamadosData);
            const top10LugaresChamados = getTop10ForLegend(lugaresChamadosData);  // Apenas para a legenda

            new Chart(document.getElementById('lugaresChamadosChart'), {
                type: 'pie',
                data: {
                    labels: sortedLugaresChamados.labels,  // Todos os dados no gráfico
                    datasets: [{
                        data: sortedLugaresChamados.values,
                        backgroundColor: generateColors(sortedLugaresChamados.labels.length),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let label = tooltipItem.label || '';
                                    let value = tooltipItem.raw || 0;
                                    return `${label} (${value})`; 
                                }
                            }
                        },
                        legend: {
                            position: 'right', 
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                boxWidth: 12,
                                generateLabels: function(chart) {
                                    const labels = chart.data.labels;
                                    // Limitar a exibição da legenda aos 10 mais
                                    return labels.slice(0, 10).map((label, index) => ({
                                        text: label,
                                        fillStyle: chart.data.datasets[0].backgroundColor[index]
                                    }));
                                }
                            }
                        }
                    }
                }
            });

            // Ordenar e configurar gráfico de status de chamados
            const sortedStatusChamados = sortData(statusChamadosData);
            new Chart(document.getElementById('statusChamadosChart'), {
                type: 'pie',
                data: {
                    labels: sortedStatusChamados.labels,
                    datasets: [{
                        data: sortedStatusChamados.values,
                        backgroundColor: generateColors(sortedStatusChamados.labels.length),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let label = tooltipItem.label || '';
                                    let value = tooltipItem.raw || 0;
                                    return `${label} (${value})`; 
                                }
                            }
                        },
                        legend: {
                            position: 'right', 
                            labels: {
                                usePointStyle: true,
                                padding: 10,
                                boxWidth: 12
                            }
                        }
                    }
                }
            });
        </script>
    @endif
</body>
</html>
