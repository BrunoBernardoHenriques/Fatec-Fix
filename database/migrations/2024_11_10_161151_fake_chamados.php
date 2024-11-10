<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
          

            DB::table('chamados')->insert(array_merge([
                [
                    'id' => 20,
                    'tipo_id' => rand(1, 6),
                    'descricao_resumida' => 'Problema de Rede',
                    'descricao_completa' => 'Usuário não consegue acessar a internet. Possível problema no roteador ou configuração de rede.',
                    'solicitante' => 'João Silva',
                    'status_id' => $status_id = rand(1, 3),
                    'local_id' => rand(1, 25),
                    'created_at' => $data_abertura = Carbon::now()->subDays(rand(1, 30)),
                    'data_encerramento' => $status_id === 3 ? $data_abertura->copy()->addDays(rand(1, 10)) : null,
                    'updated_at' => $status_id === 3 ? $data_abertura->copy()->addDays(rand(1, 10)) : $data_abertura,
                    'created_by' => 1,
                    'updated_by' => null,
                ],
                [
                    'id' => 21,
                    'tipo_id' => rand(1, 6),
                    'descricao_resumida' => 'Acesso ao Sistema ERP',
                    'descricao_completa' => 'Solicitante não consegue acessar o ERP da empresa. Mensagem de erro ao tentar fazer login.',
                    'solicitante' => 'Maria Oliveira',
                    'status_id' => $status_id = rand(1, 3),
                    'local_id' => rand(1, 25),
                    'created_at' => $data_abertura = Carbon::now()->subDays(rand(1, 30)),
                    'data_encerramento' => $status_id === 3 ? $data_abertura->copy()->addDays(rand(1, 10)) : null,
                    'updated_at' => $status_id === 3 ? $data_abertura->copy()->addDays(rand(1, 10)) : $data_abertura,
                    'created_by' => 1,
                    'updated_by' => null,
                ],
                // Continue criando outros registros individuais se necessário
            ], array_map(function($i) {
                $status_id = rand(1, 3);
                $data_abertura = Carbon::now()->subDays(rand(1, 30));
                $data_fechamento = $status_id === 3 ? $data_abertura->copy()->addDays(rand(1, 10)) : null;
            
                return [
                    'id' => 25 + $i,
                    'tipo_id' => rand(1, 6),
                    'descricao_resumida' => 'Chamado número ' . ($i + 25),
                    'descricao_completa' => 'Descrição do problema relatado no chamado número ' . ($i + 25) . '. Usuário descreve dificuldades para realizar uma tarefa específica.',
                    'solicitante' => 'Solicitante ' . $i,
                    'status_id' => $status_id,
                    'local_id' => rand(1, 25),
                    'data_encerramento' => $data_fechamento,
                    'created_at' => $data_abertura,
                    'updated_at' => $data_fechamento ?? $data_abertura,
                    'created_by' => 1,
                    'updated_by' => null
                ];
            }, range(0, 24))));
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            //
        });
    }
};
