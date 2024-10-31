<?php

namespace App\Http\Controllers;

use App\Actions\client\ClientesCadastroJsonClient;
use App\Actions\pedido\PedidoCompraJsonClient;
use Exception;
use Illuminate\Http\Request;

class Fornec extends Controller
{
    public function index()
    {
        $dados = [];
        if (isset($_GET['inicial']) && isset($_GET['final'])) {

            $inicial = \Carbon\Carbon::parse($_GET['inicial'])->format('d/m/Y');
            $final = \Carbon\Carbon::parse($_GET['final'])->format('d/m/Y');

            $lista = new PedidoCompraJsonClient;
            $param = [
                "nPagina" => 1,
                'nRegsPorPagina' => 10,
                'lApenasImportadoApi' => false,
                'lExibirPedidosPendentes' => false,
                'lExibirPedidosFaturados' => false,
                'lExibirPedidosRecebidos' => true,
                'lExibirPedidosCancelados' => false,
                'lExibirPedidosEncerrados' => false,
                'lExibirPedidosRecParciais' => true,
                'lExibirPedidosFatParciais' => false,
                'dDataInicial' => "01/10/2024",
                'dDataFinal' => "31/10/2024",
                'lApenasAlterados' => false,

                // 'nPagina' => 1,
                // 'nRegsPorPagina' => 5,
                // // 'lApenasImportadoApi' => false,
                // // 'lExibirPedidosPendentes' => false,
                // // 'lExibirPedidosFaturados' => false,
                // 'lExibirPedidosRecebidos' => true,
                // // 'lExibirPedidosCancelados' => false,
                // // 'lExibirPedidosEncerrados' => false,
                // 'lExibirPedidosRecParciais' => true,
                // // 'lExibirPedidosFatParciais' => false,
                // 'dDataInicial' => $inicial,
                // 'dDataFinal' => $final,
            ];

            // dd($inicial, $final, $param);

            $responses = $lista->PesquisarPedCompra($param);

            dd($responses);
            $fornec = new ClientesCadastroJsonClient;

            foreach ($responses->pedidos_pesquisa as $response) {
                $paramFornec = [
                    'clientesPorCodigo' => [
                        [
                            'codigo_cliente_omie' => $response->cabecalho_consulta->nCodFor
                        ]
                    ]
                ];

                $responsesFornec = $fornec->ListarClientesResumido($paramFornec);

                // array_push($dados, $responsesFornec->clientes_cadastro_resumido[0]->nome_fantasia);

                foreach ($response->produtos_consulta as $produto) {
                    array_push($dados,  [
                        $response->cabecalho_consulta->cNumero,
                        $response->cabecalho_consulta->dDtPrevisao,
                        $responsesFornec->clientes_cadastro_resumido[0]->nome_fantasia,
                        $produto->nQtde,
                        $produto->cUnidade,
                        $produto->cDescricao,
                        $produto->cObs,
                    ]);
                }
            }
        } else {
            echo "<h1> Parametros incorretos. Digite ?inicial=##/##/####&final=##/##/#### </h1>";
        }


        dd($dados);
        return view('fornec.index', compact('dados'));
    }
}
