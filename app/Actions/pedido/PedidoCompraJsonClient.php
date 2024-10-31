<?php

namespace App\Actions\pedido;

use Exception;

/**
 * @service PedidoCompraJsonClient
 * @author omie
 */
class PedidoCompraJsonClient
{
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri = 'https://app.omie.com.br/api/v1/produtos/pedidocompra/?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server = null;
	/**
	 * The endpoint URI
	 *
	 * @var string
	 */
	public static $_EndPoint = 'https://app.omie.com.br/api/v1/produtos/pedidocompra/';

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method, $param)
	{
		$call = ["call" => $method, "param" => $param, "app_key" => env('OMIE_APP_KEY'), "app_secret" => env('OMIE_APP_SECRET')];
		$url = self::$_EndPoint;
		$body = json_encode($call);
		$opts = stream_context_create(["http" => ["method" => "POST", "header" => "Content-Type: application/json", "content" => $body]]);
		$res = file_get_contents($url, false, $opts);
		if (empty($res))
			throw new Exception("Error Processing Response: $res", 1);
		return json_decode($res);
	}

	/**
	 * Incluir um Pedido de Compra
	 *
	 * @param com_pedido_incluir_request $com_pedido_incluir_request Incluir um Pedido de Compra
	 * @return com_pedido_incluir_response Resposta da Inclusão de um Pedido de Compra
	 */
	public function IncluirPedCompra($com_pedido_incluir_request)
	{
		return self::_Call('IncluirPedCompra', array(
			$com_pedido_incluir_request
		));
	}

	/**
	 * Alterar as Informações de um Pedido de Compra
	 *
	 * @param com_pedido_alterar_request $com_pedido_alterar_request Alterar um Pedido de Compra
	 * @return com_pedido_alterar_response Resposta da Alteração de um Pedido de Compra
	 */
	public function AlteraPedCompra($com_pedido_alterar_request)
	{
		return self::_Call('AlteraPedCompra', array(
			$com_pedido_alterar_request
		));
	}

	/**
	 * Excluir um Pedido de Compra
	 *
	 * @param com_pedido_excluir_request $com_pedido_excluir_request Excluir um Pedido de Compra
	 * @return com_pedido_excluir_response Resposta da Exclusão de um Pedido de Compra
	 */
	public function ExcluirPedCompra($com_pedido_excluir_request)
	{
		return self::_Call('ExcluirPedCompra', array(
			$com_pedido_excluir_request
		));
	}

	/**
	 * Upsert (inclusão ou alteração) de um Pedido de Compra
	 *
	 * @param com_pedido_upsert_request $com_pedido_upsert_request Upsert (inclusão ou alteração) de um Pedido de Compra
	 * @return com_pedido_upsert_response Resposta do Upsert de um Pedido de Compra
	 */
	public function UpsertPedCompra($com_pedido_upsert_request)
	{
		return self::_Call('UpsertPedCompra', array(
			$com_pedido_upsert_request
		));
	}

	/**
	 * Consultar as Informações de um Pedido de Compra.
	 *
	 * @param com_pedido_consultar_request $com_pedido_consultar_request Consultar um Pedido de Compra
	 * @return pedidos_pesquisa Lista com os pedidos de compra
	 */
	public function ConsultarPedCompra($com_pedido_consultar_request)
	{
		return self::_Call('ConsultarPedCompra', array(
			$com_pedido_consultar_request
		));
	}

	/**
	 * Pesquisar por Pedidos de Compra em determinada condição
	 *
	 * @param com_pedido_pesquisar_request $com_pedido_pesquisar_request Pesquisar de Pedidos de Compra
	 * @return com_pedido_pesquisar_response Resposta da Pesquisa de Pedidos de Compra
	 */
	public function PesquisarPedCompra($com_pedido_pesquisar_request)
	{
		return self::_Call('PesquisarPedCompra', array(
			$com_pedido_pesquisar_request
		));
	}
}

/**
 * Cabeçalho do Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $dDtPrevisao Data de previsão de entrega do pedido de compra
 * @pw_element string $cCodParc Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
 * @pw_element integer $nQtdeParc Quantidade de parcelas do pedido
 * @pw_element string $cCnpjCpfFor CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
 * @pw_element integer $nCodFor Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
 * @pw_element string $cCodIntFor Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_element integer $nCodCompr Código do comprador do pedido
 * @pw_element string $cContato Nome do contato no fornecedor responsável pelo pedido de compra
 * @pw_element string $cContrato Número do Contrato de Compra
 * @pw_element integer $nCodCC Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
 * @pw_element string $nCodIntCC Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
 * @pw_element integer $nCodProj Código do projeto relacionado ao pedido de compra
 * @pw_element string $cNumPedido Número do pedido para o fornecedor
 * @pw_element string $cObs Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cObsInt Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
 * @pw_complex cabecalho_alterar
 */
class cabecalho_alterar
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Data de previsão de entrega do pedido de compra
	 *
	 * @var string
	 */
	public $dDtPrevisao;
	/**
	 * Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
	 *
	 * @var string
	 */
	public $cCodParc;
	/**
	 * Quantidade de parcelas do pedido
	 *
	 * @var integer
	 */
	public $nQtdeParc;
	/**
	 * CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
	 *
	 * @var string
	 */
	public $cCnpjCpfFor;
	/**
	 * Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
	 *
	 * @var integer
	 */
	public $nCodFor;
	/**
	 * Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntFor;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Código do comprador do pedido
	 *
	 * @var integer
	 */
	public $nCodCompr;
	/**
	 * Nome do contato no fornecedor responsável pelo pedido de compra
	 *
	 * @var string
	 */
	public $cContato;
	/**
	 * Número do Contrato de Compra
	 *
	 * @var string
	 */
	public $cContrato;
	/**
	 * Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
	 *
	 * @var string
	 */
	public $nCodIntCC;
	/**
	 * Código do projeto relacionado ao pedido de compra
	 *
	 * @var integer
	 */
	public $nCodProj;
	/**
	 * Número do pedido para o fornecedor
	 *
	 * @var string
	 */
	public $cNumPedido;
	/**
	 * Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
	 *
	 * @var string
	 */
	public $cObsInt;
}

/**
 * Cabeçalho do Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $dIncData Data de inclusão ou de criação
 * @pw_element string $cIncHora Hora de inclusão ou de criação
 * @pw_element string $cEtapa Etapa atual do pedido de compra
 * @pw_element string $cNumero Número do pedido de compra
 * @pw_element string $dDtPrevisao Data de previsão de entrega do pedido de compra
 * @pw_element string $cCodParc Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
 * @pw_element integer $nQtdeParc Quantidade de parcelas do pedido
 * @pw_element integer $nCodFor Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
 * @pw_element string $cCodIntFor Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_element integer $nCodCompr Código do comprador do pedido
 * @pw_element string $cContato Nome do contato no fornecedor responsável pelo pedido de compra
 * @pw_element string $cContrato Número do Contrato de Compra
 * @pw_element integer $nCodCC Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
 * @pw_element string $nCodIntCC Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
 * @pw_element integer $nCodProj Código do projeto relacionado ao pedido de compra
 * @pw_element string $cNumPedido Número do pedido para o fornecedor
 * @pw_element string $cObs Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cObsInt Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
 * @pw_complex cabecalho_consulta
 */
class cabecalho_consulta
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Data de inclusão ou de criação
	 *
	 * @var string
	 */
	public $dIncData;
	/**
	 * Hora de inclusão ou de criação
	 *
	 * @var string
	 */
	public $cIncHora;
	/**
	 * Etapa atual do pedido de compra
	 *
	 * @var string
	 */
	public $cEtapa;
	/**
	 * Número do pedido de compra
	 *
	 * @var string
	 */
	public $cNumero;
	/**
	 * Data de previsão de entrega do pedido de compra
	 *
	 * @var string
	 */
	public $dDtPrevisao;
	/**
	 * Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
	 *
	 * @var string
	 */
	public $cCodParc;
	/**
	 * Quantidade de parcelas do pedido
	 *
	 * @var integer
	 */
	public $nQtdeParc;
	/**
	 * Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
	 *
	 * @var integer
	 */
	public $nCodFor;
	/**
	 * Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntFor;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Código do comprador do pedido
	 *
	 * @var integer
	 */
	public $nCodCompr;
	/**
	 * Nome do contato no fornecedor responsável pelo pedido de compra
	 *
	 * @var string
	 */
	public $cContato;
	/**
	 * Número do Contrato de Compra
	 *
	 * @var string
	 */
	public $cContrato;
	/**
	 * Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
	 *
	 * @var string
	 */
	public $nCodIntCC;
	/**
	 * Código do projeto relacionado ao pedido de compra
	 *
	 * @var integer
	 */
	public $nCodProj;
	/**
	 * Número do pedido para o fornecedor
	 *
	 * @var string
	 */
	public $cNumPedido;
	/**
	 * Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
	 *
	 * @var string
	 */
	public $cObsInt;
}

/**
 * Cabeçalho do Pedido de Compra
 *
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $dDtPrevisao Data de previsão de entrega do pedido de compra
 * @pw_element string $cCodParc Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
 * @pw_element integer $nQtdeParc Quantidade de parcelas do pedido
 * @pw_element string $cCnpjCpfFor CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
 * @pw_element integer $nCodFor Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
 * @pw_element string $cCodIntFor Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_element integer $nCodCompr Código do comprador do pedido
 * @pw_element string $cContato Nome do contato no fornecedor responsável pelo pedido de compra
 * @pw_element string $cContrato Número do Contrato de Compra
 * @pw_element integer $nCodCC Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
 * @pw_element string $nCodIntCC Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
 * @pw_element integer $nCodProj Código do projeto relacionado ao pedido de compra
 * @pw_element string $cNumPedido Número do pedido para o fornecedor
 * @pw_element string $cObs Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cObsInt Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
 * @pw_element string $cEmailAprovador Informe aqui o E-mail do usúario que irá aprovar o pedido.<BR>Esse usúario deve ter permissão de acesso para realizar a aprovação.<BR><BR>Ao informar esse campo o pedido de compra será atribuído a etapa de aprovação com o status de aprovado.<BR><BR>Preenchimento opcional.
 * @pw_complex cabecalho_incluir
 */
class cabecalho_incluir
{
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Data de previsão de entrega do pedido de compra
	 *
	 * @var string
	 */
	public $dDtPrevisao;
	/**
	 * Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
	 *
	 * @var string
	 */
	public $cCodParc;
	/**
	 * Quantidade de parcelas do pedido
	 *
	 * @var integer
	 */
	public $nQtdeParc;
	/**
	 * CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
	 *
	 * @var string
	 */
	public $cCnpjCpfFor;
	/**
	 * Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
	 *
	 * @var integer
	 */
	public $nCodFor;
	/**
	 * Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntFor;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Código do comprador do pedido
	 *
	 * @var integer
	 */
	public $nCodCompr;
	/**
	 * Nome do contato no fornecedor responsável pelo pedido de compra
	 *
	 * @var string
	 */
	public $cContato;
	/**
	 * Número do Contrato de Compra
	 *
	 * @var string
	 */
	public $cContrato;
	/**
	 * Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
	 *
	 * @var string
	 */
	public $nCodIntCC;
	/**
	 * Código do projeto relacionado ao pedido de compra
	 *
	 * @var integer
	 */
	public $nCodProj;
	/**
	 * Número do pedido para o fornecedor
	 *
	 * @var string
	 */
	public $cNumPedido;
	/**
	 * Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
	 *
	 * @var string
	 */
	public $cObsInt;
	/**
	 * Informe aqui o E-mail do usúario que irá aprovar o pedido.<BR>Esse usúario deve ter permissão de acesso para realizar a aprovação.<BR><BR>Ao informar esse campo o pedido de compra será atribuído a etapa de aprovação com o status de aprovado.<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $cEmailAprovador;
}

/**
 * Cabeçalho do Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $dDtPrevisao Data de previsão de entrega do pedido de compra
 * @pw_element string $cCodParc Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
 * @pw_element integer $nQtdeParc Quantidade de parcelas do pedido
 * @pw_element string $cCnpjCpfFor CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
 * @pw_element integer $nCodFor Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
 * @pw_element string $cCodIntFor Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_element integer $nCodCompr Código do comprador do pedido
 * @pw_element string $cContato Nome do contato no fornecedor responsável pelo pedido de compra
 * @pw_element string $cContrato Número do Contrato de Compra
 * @pw_element integer $nCodCC Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
 * @pw_element string $nCodIntCC Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
 * @pw_element integer $nCodProj Código do projeto relacionado ao pedido de compra
 * @pw_element string $cNumPedido Número do pedido para o fornecedor
 * @pw_element string $cObs Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cObsInt Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
 * @pw_element string $cEmailAprovador Informe aqui o E-mail do usúario que irá aprovar o pedido.<BR>Esse usúario deve ter permissão de acesso para realizar a aprovação.<BR><BR>Ao informar esse campo o pedido de compra será atribuído a etapa de aprovação com o status de aprovado.<BR><BR>Preenchimento opcional.
 * @pw_complex cabecalho_upsert
 */
class cabecalho_upsert
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Data de previsão de entrega do pedido de compra
	 *
	 * @var string
	 */
	public $dDtPrevisao;
	/**
	 * Código da Condição de Pagamento/Parcelamento.<BR><BR>"999" - Padrão.
	 *
	 * @var string
	 */
	public $cCodParc;
	/**
	 * Quantidade de parcelas do pedido
	 *
	 * @var integer
	 */
	public $nQtdeParc;
	/**
	 * CNPJ / CPF<BR><BR>Preenchimento opcional. <BR>Quando informada as tags nCodFor e cCodIntFor não devem ser informadas.
	 *
	 * @var string
	 */
	public $cCnpjCpfFor;
	/**
	 * Código interno do fornecedor do pedido (este é o código do fornecedor no Omie)
	 *
	 * @var integer
	 */
	public $nCodFor;
	/**
	 * Código de integração do fornecedor do pedido (este é o código do fornecedor no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntFor;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Código do comprador do pedido
	 *
	 * @var integer
	 */
	public $nCodCompr;
	/**
	 * Nome do contato no fornecedor responsável pelo pedido de compra
	 *
	 * @var string
	 */
	public $cContato;
	/**
	 * Número do Contrato de Compra
	 *
	 * @var string
	 */
	public $cContrato;
	/**
	 * Código interno da conta corrente do pedido de compra (este é o código da conta corrente no Omie)
	 *
	 * @var integer
	 */
	public $nCodCC;
	/**
	 * Código de integração da conta corrente do pedido (este é o código da conta corrente no seu sistema)
	 *
	 * @var string
	 */
	public $nCodIntCC;
	/**
	 * Código do projeto relacionado ao pedido de compra
	 *
	 * @var integer
	 */
	public $nCodProj;
	/**
	 * Número do pedido para o fornecedor
	 *
	 * @var string
	 */
	public $cNumPedido;
	/**
	 * Observações do pedido de compra (elas não serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Observações internas do pedido (elas serão exibidas apenas para quem consultar o pedido de compra)
	 *
	 * @var string
	 */
	public $cObsInt;
	/**
	 * Informe aqui o E-mail do usúario que irá aprovar o pedido.<BR>Esse usúario deve ter permissão de acesso para realizar a aprovação.<BR><BR>Ao informar esse campo o pedido de compra será atribuído a etapa de aprovação com o status de aprovado.<BR><BR>Preenchimento opcional.
	 *
	 * @var string
	 */
	public $cEmailAprovador;
}

/**
 * Alterar um Pedido de Compra
 *
 * @pw_element cabecalho_alterar $cabecalho_alterar Cabeçalho do Pedido de Compra
 * @pw_element frete_alterar $frete_alterar Frete, Transporte e Outras Despesas do Pedido de Compra
 * @pw_element produtos_alterarArray $produtos_alterar Produtos do Pedido de Compra
 * @pw_element departamentos_alterarArray $departamentos_alterar Rateio do Pedido de Compra por departamento
 * @pw_element parcelas_alterarArray $parcelas_alterar Parcelas  do Pedido de Compra.
 * @pw_complex com_pedido_alterar_request
 */
class com_pedido_alterar_request
{
	/**
	 * Cabeçalho do Pedido de Compra
	 *
	 * @var cabecalho_alterar
	 */
	public $cabecalho_alterar;
	/**
	 * Frete, Transporte e Outras Despesas do Pedido de Compra
	 *
	 * @var frete_alterar
	 */
	public $frete_alterar;
	/**
	 * Produtos do Pedido de Compra
	 *
	 * @var produtos_alterarArray
	 */
	public $produtos_alterar;
	/**
	 * Rateio do Pedido de Compra por departamento
	 *
	 * @var departamentos_alterarArray
	 */
	public $departamentos_alterar;
	/**
	 * Parcelas  do Pedido de Compra.
	 *
	 * @var parcelas_alterarArray
	 */
	public $parcelas_alterar;
}

/**
 * Frete, Transporte e Outras Despesas do Pedido de Compra
 *
 * @pw_element integer $nCodTransp Código interno da transportadora (este é o código da transportadora no Omie)
 * @pw_element string $cCodIntTransp Código de integração da transportadora (este é o código da transportadora no seu sistema)
 * @pw_element string $cTpFrete Modalidade do frete no pedido
 * @pw_element string $cPlaca Placa do veículo de transporte
 * @pw_element string $cUF UF da placa do veículo do transporte
 * @pw_element integer $nQtdVol Quantidade de volumes
 * @pw_element string $cEspVol Espécie dos volumes
 * @pw_element string $cMarVol Marca dos volumes
 * @pw_element string $cNumVol Numeração dos volumes
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nValFrete Valor do frete
 * @pw_element decimal $nValSeguro Valor do seguro
 * @pw_element string $cLacre Número do lacre
 * @pw_element decimal $nValOutras Valor das outras despesas acessórias
 * @pw_complex frete_alterar
 */
class frete_alterar
{
	/**
	 * Código interno da transportadora (este é o código da transportadora no Omie)
	 *
	 * @var integer
	 */
	public $nCodTransp;
	/**
	 * Código de integração da transportadora (este é o código da transportadora no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntTransp;
	/**
	 * Modalidade do frete no pedido
	 *
	 * @var string
	 */
	public $cTpFrete;
	/**
	 * Placa do veículo de transporte
	 *
	 * @var string
	 */
	public $cPlaca;
	/**
	 * UF da placa do veículo do transporte
	 *
	 * @var string
	 */
	public $cUF;
	/**
	 * Quantidade de volumes
	 *
	 * @var integer
	 */
	public $nQtdVol;
	/**
	 * Espécie dos volumes
	 *
	 * @var string
	 */
	public $cEspVol;
	/**
	 * Marca dos volumes
	 *
	 * @var string
	 */
	public $cMarVol;
	/**
	 * Numeração dos volumes
	 *
	 * @var string
	 */
	public $cNumVol;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Valor do frete
	 *
	 * @var decimal
	 */
	public $nValFrete;
	/**
	 * Valor do seguro
	 *
	 * @var decimal
	 */
	public $nValSeguro;
	/**
	 * Número do lacre
	 *
	 * @var string
	 */
	public $cLacre;
	/**
	 * Valor das outras despesas acessórias
	 *
	 * @var decimal
	 */
	public $nValOutras;
}

/**
 * Produtos do Pedido de Compra
 *
 * @pw_element string $cCodIntItem Código de integração do item do pedido de compra (este é o código do item no seu sistema)
 * @pw_element integer $nCodItem Código interno do item do pedido de compra (este é o código do item no Omie)
 * @pw_element string $cCodIntProd Código de integração do cadastro do produto (este é o código do produto no seu sistema)
 * @pw_element integer $nCodProd Código interno do cadastro do produto (este é o código do produto no Omie)
 * @pw_element string $cProduto Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
 * @pw_element string $cDescricao Descrição do item no pedido
 * @pw_element string $cNCM Código NCM do item
 * @pw_element string $cUnidade Unidade do item no pedido
 * @pw_element string $cEAN Código EAN / GTIN do item no pedido
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nQtde Quantidade do item no pedido
 * @pw_element decimal $nValUnit Valor unitário do item no pedido
 * @pw_element decimal $nDesconto Valor do desconto do item no pedido
 * @pw_element decimal $nValorIcms Valor do ICMS
 * @pw_element decimal $nValorSt Valor do ICMS ST
 * @pw_element decimal $nValorIpi Valor do IPI
 * @pw_element decimal $nValorPis Valor do PIS
 * @pw_element decimal $nValorCofins Valor do COFINS
 * @pw_element string $cObs Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cMkpAtuPv Indica que deve atualizar o preço de venda do produto no recebimento
 * @pw_element string $cMkpAtuSm Indica que deve atualizar o preço apenas se for maior que o atual
 * @pw_element decimal $nMkpPerc Percentual a ser utilizado para a atualização do preço de venda do produto
 * @pw_element integer $codigo_local_estoque Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_complex produtos_alterar
 */
class produtos_alterar
{
	/**
	 * Código de integração do item do pedido de compra (este é o código do item no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntItem;
	/**
	 * Código interno do item do pedido de compra (este é o código do item no Omie)
	 *
	 * @var integer
	 */
	public $nCodItem;
	/**
	 * Código de integração do cadastro do produto (este é o código do produto no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código interno do cadastro do produto (este é o código do produto no Omie)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
	 *
	 * @var string
	 */
	public $cProduto;
	/**
	 * Descrição do item no pedido
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Código NCM do item
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * Unidade do item no pedido
	 *
	 * @var string
	 */
	public $cUnidade;
	/**
	 * Código EAN / GTIN do item no pedido
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Quantidade do item no pedido
	 *
	 * @var decimal
	 */
	public $nQtde;
	/**
	 * Valor unitário do item no pedido
	 *
	 * @var decimal
	 */
	public $nValUnit;
	/**
	 * Valor do desconto do item no pedido
	 *
	 * @var decimal
	 */
	public $nDesconto;
	/**
	 * Valor do ICMS
	 *
	 * @var decimal
	 */
	public $nValorIcms;
	/**
	 * Valor do ICMS ST
	 *
	 * @var decimal
	 */
	public $nValorSt;
	/**
	 * Valor do IPI
	 *
	 * @var decimal
	 */
	public $nValorIpi;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $nValorPis;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $nValorCofins;
	/**
	 * Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Indica que deve atualizar o preço de venda do produto no recebimento
	 *
	 * @var string
	 */
	public $cMkpAtuPv;
	/**
	 * Indica que deve atualizar o preço apenas se for maior que o atual
	 *
	 * @var string
	 */
	public $cMkpAtuSm;
	/**
	 * Percentual a ser utilizado para a atualização do preço de venda do produto
	 *
	 * @var decimal
	 */
	public $nMkpPerc;
	/**
	 * Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
	 *
	 * @var integer
	 */
	public $codigo_local_estoque;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
}


/**
 * Rateio do Pedido de Compra por departamento
 *
 * @pw_element string $cCodDepto Código do Departamento
 * @pw_element decimal $nPerc Percentual de rateio
 * @pw_complex departamentos_alterar
 */
class departamentos_alterar
{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDepto;
	/**
	 * Percentual de rateio
	 *
	 * @var decimal
	 */
	public $nPerc;
}


/**
 * Parcelas  do Pedido de Compra.
 *
 * @pw_element integer $nParcela Número da parcela
 * @pw_element string $dVencto Data de vencimento da parcela
 * @pw_element decimal $nValor Valor da parcela
 * @pw_element integer $nDias Dias para vencimento da parcela (a partir da data de previsão de entrega)
 * @pw_element decimal $nPercent Percentual da parcela em relação ao total do pedido de compra
 * @pw_element string $cTipoDoc Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
 * @pw_complex parcelas_alterar
 */
class parcelas_alterar
{
	/**
	 * Número da parcela
	 *
	 * @var integer
	 */
	public $nParcela;
	/**
	 * Data de vencimento da parcela
	 *
	 * @var string
	 */
	public $dVencto;
	/**
	 * Valor da parcela
	 *
	 * @var decimal
	 */
	public $nValor;
	/**
	 * Dias para vencimento da parcela (a partir da data de previsão de entrega)
	 *
	 * @var integer
	 */
	public $nDias;
	/**
	 * Percentual da parcela em relação ao total do pedido de compra
	 *
	 * @var decimal
	 */
	public $nPercent;
	/**
	 * Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
	 *
	 * @var string
	 */
	public $cTipoDoc;
}


/**
 * Resposta da Alteração de um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $cCodStatus Código do status
 * @pw_element string $cDescStatus Descrição do status
 * @pw_element string $cNumero Número do pedido de compra
 * @pw_complex com_pedido_alterar_response
 */
class com_pedido_alterar_response
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Código do status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $cDescStatus;
	/**
	 * Número do pedido de compra
	 *
	 * @var string
	 */
	public $cNumero;
}

/**
 * Consultar um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $cNumero Número do pedido de compra
 * @pw_complex com_pedido_consultar_request
 */
class com_pedido_consultar_request
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Número do pedido de compra
	 *
	 * @var string
	 */
	public $cNumero;
}

/**
 * Excluir um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_complex com_pedido_excluir_request
 */
class com_pedido_excluir_request
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
}

/**
 * Resposta da Exclusão de um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $cCodStatus Código do status
 * @pw_element string $cDescStatus Descrição do status
 * @pw_complex com_pedido_excluir_response
 */
class com_pedido_excluir_response
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Código do status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $cDescStatus;
}

/**
 * Incluir um Pedido de Compra
 *
 * @pw_element cabecalho_incluir $cabecalho_incluir Cabeçalho do Pedido de Compra
 * @pw_element frete_incluir $frete_incluir Frete, Transporte e Outras Despesas do Pedido de Compra
 * @pw_element produtos_incluirArray $produtos_incluir Produtos do Pedido de Compra
 * @pw_element departamentos_incluirArray $departamentos_incluir Rateio do Pedido de Compra por departamento
 * @pw_element parcelas_incluirArray $parcelas_incluir Parcelas  do Pedido de Compra.
 * @pw_complex com_pedido_incluir_request
 */
class com_pedido_incluir_request
{
	/**
	 * Cabeçalho do Pedido de Compra
	 *
	 * @var cabecalho_incluir
	 */
	public $cabecalho_incluir;
	/**
	 * Frete, Transporte e Outras Despesas do Pedido de Compra
	 *
	 * @var frete_incluir
	 */
	public $frete_incluir;
	/**
	 * Produtos do Pedido de Compra
	 *
	 * @var produtos_incluirArray
	 */
	public $produtos_incluir;
	/**
	 * Rateio do Pedido de Compra por departamento
	 *
	 * @var departamentos_incluirArray
	 */
	public $departamentos_incluir;
	/**
	 * Parcelas  do Pedido de Compra.
	 *
	 * @var parcelas_incluirArray
	 */
	public $parcelas_incluir;
}

/**
 * Frete, Transporte e Outras Despesas do Pedido de Compra
 *
 * @pw_element integer $nCodTransp Código interno da transportadora (este é o código da transportadora no Omie)
 * @pw_element string $cCodIntTransp Código de integração da transportadora (este é o código da transportadora no seu sistema)
 * @pw_element string $cTpFrete Modalidade do frete no pedido
 * @pw_element string $cPlaca Placa do veículo de transporte
 * @pw_element string $cUF UF da placa do veículo do transporte
 * @pw_element integer $nQtdVol Quantidade de volumes
 * @pw_element string $cEspVol Espécie dos volumes
 * @pw_element string $cMarVol Marca dos volumes
 * @pw_element string $cNumVol Numeração dos volumes
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nValFrete Valor do frete
 * @pw_element decimal $nValSeguro Valor do seguro
 * @pw_element string $cLacre Número do lacre
 * @pw_element decimal $nValOutras Valor das outras despesas acessórias
 * @pw_complex frete_incluir
 */
class frete_incluir
{
	/**
	 * Código interno da transportadora (este é o código da transportadora no Omie)
	 *
	 * @var integer
	 */
	public $nCodTransp;
	/**
	 * Código de integração da transportadora (este é o código da transportadora no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntTransp;
	/**
	 * Modalidade do frete no pedido
	 *
	 * @var string
	 */
	public $cTpFrete;
	/**
	 * Placa do veículo de transporte
	 *
	 * @var string
	 */
	public $cPlaca;
	/**
	 * UF da placa do veículo do transporte
	 *
	 * @var string
	 */
	public $cUF;
	/**
	 * Quantidade de volumes
	 *
	 * @var integer
	 */
	public $nQtdVol;
	/**
	 * Espécie dos volumes
	 *
	 * @var string
	 */
	public $cEspVol;
	/**
	 * Marca dos volumes
	 *
	 * @var string
	 */
	public $cMarVol;
	/**
	 * Numeração dos volumes
	 *
	 * @var string
	 */
	public $cNumVol;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Valor do frete
	 *
	 * @var decimal
	 */
	public $nValFrete;
	/**
	 * Valor do seguro
	 *
	 * @var decimal
	 */
	public $nValSeguro;
	/**
	 * Número do lacre
	 *
	 * @var string
	 */
	public $cLacre;
	/**
	 * Valor das outras despesas acessórias
	 *
	 * @var decimal
	 */
	public $nValOutras;
}

/**
 * Produtos do Pedido de Compra
 *
 * @pw_element string $cCodIntItem Código de integração do item do pedido de compra (este é o código do item no seu sistema)
 * @pw_element string $cCodIntProd Código de integração do cadastro do produto (este é o código do produto no seu sistema)
 * @pw_element integer $nCodProd Código interno do cadastro do produto (este é o código do produto no Omie)
 * @pw_element string $cProduto Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
 * @pw_element string $cDescricao Descrição do item no pedido
 * @pw_element string $cNCM Código NCM do item
 * @pw_element string $cUnidade Unidade do item no pedido
 * @pw_element string $cEAN Código EAN / GTIN do item no pedido
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nQtde Quantidade do item no pedido
 * @pw_element decimal $nValUnit Valor unitário do item no pedido
 * @pw_element decimal $nDesconto Valor do desconto do item no pedido
 * @pw_element decimal $nValorIcms Valor do ICMS
 * @pw_element decimal $nValorSt Valor do ICMS ST
 * @pw_element decimal $nValorIpi Valor do IPI
 * @pw_element decimal $nValorPis Valor do PIS
 * @pw_element decimal $nValorCofins Valor do COFINS
 * @pw_element string $cObs Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cMkpAtuPv Indica que deve atualizar o preço de venda do produto no recebimento
 * @pw_element string $cMkpAtuSm Indica que deve atualizar o preço apenas se for maior que o atual
 * @pw_element decimal $nMkpPerc Percentual a ser utilizado para a atualização do preço de venda do produto
 * @pw_element integer $codigo_local_estoque Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_complex produtos_incluir
 */
class produtos_incluir
{
	/**
	 * Código de integração do item do pedido de compra (este é o código do item no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntItem;
	/**
	 * Código de integração do cadastro do produto (este é o código do produto no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código interno do cadastro do produto (este é o código do produto no Omie)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
	 *
	 * @var string
	 */
	public $cProduto;
	/**
	 * Descrição do item no pedido
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Código NCM do item
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * Unidade do item no pedido
	 *
	 * @var string
	 */
	public $cUnidade;
	/**
	 * Código EAN / GTIN do item no pedido
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Quantidade do item no pedido
	 *
	 * @var decimal
	 */
	public $nQtde;
	/**
	 * Valor unitário do item no pedido
	 *
	 * @var decimal
	 */
	public $nValUnit;
	/**
	 * Valor do desconto do item no pedido
	 *
	 * @var decimal
	 */
	public $nDesconto;
	/**
	 * Valor do ICMS
	 *
	 * @var decimal
	 */
	public $nValorIcms;
	/**
	 * Valor do ICMS ST
	 *
	 * @var decimal
	 */
	public $nValorSt;
	/**
	 * Valor do IPI
	 *
	 * @var decimal
	 */
	public $nValorIpi;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $nValorPis;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $nValorCofins;
	/**
	 * Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Indica que deve atualizar o preço de venda do produto no recebimento
	 *
	 * @var string
	 */
	public $cMkpAtuPv;
	/**
	 * Indica que deve atualizar o preço apenas se for maior que o atual
	 *
	 * @var string
	 */
	public $cMkpAtuSm;
	/**
	 * Percentual a ser utilizado para a atualização do preço de venda do produto
	 *
	 * @var decimal
	 */
	public $nMkpPerc;
	/**
	 * Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
	 *
	 * @var integer
	 */
	public $codigo_local_estoque;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
}


/**
 * Rateio do Pedido de Compra por departamento
 *
 * @pw_element string $cCodDepto Código do Departamento
 * @pw_element decimal $nPerc Percentual de rateio
 * @pw_complex departamentos_incluir
 */
class departamentos_incluir
{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDepto;
	/**
	 * Percentual de rateio
	 *
	 * @var decimal
	 */
	public $nPerc;
}


/**
 * Parcelas  do Pedido de Compra.
 *
 * @pw_element integer $nParcela Número da parcela
 * @pw_element string $dVencto Data de vencimento da parcela
 * @pw_element decimal $nValor Valor da parcela
 * @pw_element integer $nDias Dias para vencimento da parcela (a partir da data de previsão de entrega)
 * @pw_element decimal $nPercent Percentual da parcela em relação ao total do pedido de compra
 * @pw_element string $cTipoDoc Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
 * @pw_complex parcelas_incluir
 */
class parcelas_incluir
{
	/**
	 * Número da parcela
	 *
	 * @var integer
	 */
	public $nParcela;
	/**
	 * Data de vencimento da parcela
	 *
	 * @var string
	 */
	public $dVencto;
	/**
	 * Valor da parcela
	 *
	 * @var decimal
	 */
	public $nValor;
	/**
	 * Dias para vencimento da parcela (a partir da data de previsão de entrega)
	 *
	 * @var integer
	 */
	public $nDias;
	/**
	 * Percentual da parcela em relação ao total do pedido de compra
	 *
	 * @var decimal
	 */
	public $nPercent;
	/**
	 * Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
	 *
	 * @var string
	 */
	public $cTipoDoc;
}


/**
 * Resposta da Inclusão de um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $cCodStatus Código do status
 * @pw_element string $cDescStatus Descrição do status
 * @pw_element string $cNumero Número do pedido de compra
 * @pw_complex com_pedido_incluir_response
 */
class com_pedido_incluir_response
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Código do status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $cDescStatus;
	/**
	 * Número do pedido de compra
	 *
	 * @var string
	 */
	public $cNumero;
}

/**
 * Pesquisar de Pedidos de Compra
 *
 * @pw_element integer $nPagina Página da pesquisa
 * @pw_element integer $nRegsPorPagina Registros por página
 * @pw_element string $lApenasImportadoApi Exibir apenas pedidos importados por esta API
 * @pw_element string $lExibirPedidosPendentes Exibir os pedidos de compra pendentes
 * @pw_element string $lExibirPedidosFaturados Exibir os pedidos de compra faturados pelo fornecedor
 * @pw_element string $lExibirPedidosRecebidos Exibir os pedidos de compra recebidos
 * @pw_element string $lExibirPedidosCancelados Exibir os pedidos de compra cancelados
 * @pw_element string $lExibirPedidosEncerrados Exibir os pedidos de compra encerrados
 * @pw_element string $lExibirPedidosRecParciais Exibir os pedidos de compra recebidos parcialmente.
 * @pw_element string $lExibirPedidosFatParciais Exibir os pedidos de compra faturados parcialmente.
 * @pw_element string $dDataInicial Exibir os pedidos de compra a partir desta data
 * @pw_element string $dDataFinal Exibir os pedidos de compra até esta data
 * @pw_element boolean $lApenasAlterados Exibir apenas pedidos alterados no periodo.<BR><BR>Default = false
 * @pw_complex com_pedido_pesquisar_request
 */
class com_pedido_pesquisar_request
{
	/**
	 * Página da pesquisa
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Registros por página
	 *
	 * @var integer
	 */
	public $nRegsPorPagina;
	/**
	 * Exibir apenas pedidos importados por esta API
	 *
	 * @var string
	 */
	public $lApenasImportadoApi;
	/**
	 * Exibir os pedidos de compra pendentes
	 *
	 * @var string
	 */
	public $lExibirPedidosPendentes;
	/**
	 * Exibir os pedidos de compra faturados pelo fornecedor
	 *
	 * @var string
	 */
	public $lExibirPedidosFaturados;
	/**
	 * Exibir os pedidos de compra recebidos
	 *
	 * @var string
	 */
	public $lExibirPedidosRecebidos;
	/**
	 * Exibir os pedidos de compra cancelados
	 *
	 * @var string
	 */
	public $lExibirPedidosCancelados;
	/**
	 * Exibir os pedidos de compra encerrados
	 *
	 * @var string
	 */
	public $lExibirPedidosEncerrados;
	/**
	 * Exibir os pedidos de compra recebidos parcialmente.
	 *
	 * @var string
	 */
	public $lExibirPedidosRecParciais;
	/**
	 * Exibir os pedidos de compra faturados parcialmente.
	 *
	 * @var string
	 */
	public $lExibirPedidosFatParciais;
	/**
	 * Exibir os pedidos de compra a partir desta data
	 *
	 * @var string
	 */
	public $dDataInicial;
	/**
	 * Exibir os pedidos de compra até esta data
	 *
	 * @var string
	 */
	public $dDataFinal;
	/**
	 * Exibir apenas pedidos alterados no periodo.<BR><BR>Default = false
	 *
	 * @var boolean
	 */
	public $lApenasAlterados;
}

/**
 * Resposta da Pesquisa de Pedidos de Compra
 *
 * @pw_element integer $nPagina Página da pesquisa
 * @pw_element integer $nRegsPorPagina Registros por página
 * @pw_element string $lApenasImportadoApi Exibir apenas pedidos importados por esta API
 * @pw_element string $lExibirPedidosPendentes Exibir os pedidos de compra pendentes
 * @pw_element string $lExibirPedidosFaturados Exibir os pedidos de compra faturados pelo fornecedor
 * @pw_element string $lExibirPedidosRecebidos Exibir os pedidos de compra recebidos
 * @pw_element string $lExibirPedidosCancelados Exibir os pedidos de compra cancelados
 * @pw_element string $lExibirPedidosEncerrados Exibir os pedidos de compra encerrados
 * @pw_element string $dDataInicial Exibir os pedidos de compra a partir desta data
 * @pw_element string $dDataFinal Exibir os pedidos de compra até esta data
 * @pw_element integer $nTotalPaginas Total de páginas disponíveis na pesquisa
 * @pw_element integer $nTotalRegistros Total de registros disponíveis na pesquisa
 * @pw_element pedidos_pesquisaArray $pedidos_pesquisa Lista com os pedidos de compra
 * @pw_complex com_pedido_pesquisar_response
 */
class com_pedido_pesquisar_response
{
	/**
	 * Página da pesquisa
	 *
	 * @var integer
	 */
	public $nPagina;
	/**
	 * Registros por página
	 *
	 * @var integer
	 */
	public $nRegsPorPagina;
	/**
	 * Exibir apenas pedidos importados por esta API
	 *
	 * @var string
	 */
	public $lApenasImportadoApi;
	/**
	 * Exibir os pedidos de compra pendentes
	 *
	 * @var string
	 */
	public $lExibirPedidosPendentes;
	/**
	 * Exibir os pedidos de compra faturados pelo fornecedor
	 *
	 * @var string
	 */
	public $lExibirPedidosFaturados;
	/**
	 * Exibir os pedidos de compra recebidos
	 *
	 * @var string
	 */
	public $lExibirPedidosRecebidos;
	/**
	 * Exibir os pedidos de compra cancelados
	 *
	 * @var string
	 */
	public $lExibirPedidosCancelados;
	/**
	 * Exibir os pedidos de compra encerrados
	 *
	 * @var string
	 */
	public $lExibirPedidosEncerrados;
	/**
	 * Exibir os pedidos de compra a partir desta data
	 *
	 * @var string
	 */
	public $dDataInicial;
	/**
	 * Exibir os pedidos de compra até esta data
	 *
	 * @var string
	 */
	public $dDataFinal;
	/**
	 * Total de páginas disponíveis na pesquisa
	 *
	 * @var integer
	 */
	public $nTotalPaginas;
	/**
	 * Total de registros disponíveis na pesquisa
	 *
	 * @var integer
	 */
	public $nTotalRegistros;
	/**
	 * Lista com os pedidos de compra
	 *
	 * @var pedidos_pesquisaArray
	 */
	public $pedidos_pesquisa;
}

/**
 * Lista com os pedidos de compra
 *
 * @pw_element cabecalho_consulta $cabecalho_consulta Cabeçalho do Pedido de Compra
 * @pw_element frete_consulta $frete_consulta Frete, Transporte e Outras Despesas do Pedido de Compra
 * @pw_element produtos_consultaArray $produtos_consulta Produtos do Pedido de Compra
 * @pw_element parcelas_consultaArray $parcelas_consulta Parcelas do Pedido de Compras
 * @pw_element departamentos_consultaArray $departamentos_consulta Departamentos do Pedido de Compras
 * @pw_complex pedidos_pesquisa
 */
class pedidos_pesquisa
{
	/**
	 * Cabeçalho do Pedido de Compra
	 *
	 * @var cabecalho_consulta
	 */
	public $cabecalho_consulta;
	/**
	 * Frete, Transporte e Outras Despesas do Pedido de Compra
	 *
	 * @var frete_consulta
	 */
	public $frete_consulta;
	/**
	 * Produtos do Pedido de Compra
	 *
	 * @var produtos_consultaArray
	 */
	public $produtos_consulta;
	/**
	 * Parcelas do Pedido de Compras
	 *
	 * @var parcelas_consultaArray
	 */
	public $parcelas_consulta;
	/**
	 * Departamentos do Pedido de Compras
	 *
	 * @var departamentos_consultaArray
	 */
	public $departamentos_consulta;
}


/**
 * Upsert (inclusão ou alteração) de um Pedido de Compra
 *
 * @pw_element cabecalho_upsert $cabecalho_upsert Cabeçalho do Pedido de Compra
 * @pw_element frete_upsert $frete_upsert Frete, Transporte e Outras Despesas do Pedido de Compra
 * @pw_element produtos_upsertArray $produtos_upsert Produtos do Pedido de Compra
 * @pw_element departamentos_upsertArray $departamentos_upsert Rateio do Pedido de Compra por departamento
 * @pw_element parcelas_upsertArray $parcelas_upsert Parcelas  do Pedido de Compra.
 * @pw_complex com_pedido_upsert_request
 */
class com_pedido_upsert_request
{
	/**
	 * Cabeçalho do Pedido de Compra
	 *
	 * @var cabecalho_upsert
	 */
	public $cabecalho_upsert;
	/**
	 * Frete, Transporte e Outras Despesas do Pedido de Compra
	 *
	 * @var frete_upsert
	 */
	public $frete_upsert;
	/**
	 * Produtos do Pedido de Compra
	 *
	 * @var produtos_upsertArray
	 */
	public $produtos_upsert;
	/**
	 * Rateio do Pedido de Compra por departamento
	 *
	 * @var departamentos_upsertArray
	 */
	public $departamentos_upsert;
	/**
	 * Parcelas  do Pedido de Compra.
	 *
	 * @var parcelas_upsertArray
	 */
	public $parcelas_upsert;
}

/**
 * Frete, Transporte e Outras Despesas do Pedido de Compra
 *
 * @pw_element integer $nCodTransp Código interno da transportadora (este é o código da transportadora no Omie)
 * @pw_element string $cCodIntTransp Código de integração da transportadora (este é o código da transportadora no seu sistema)
 * @pw_element string $cTpFrete Modalidade do frete no pedido
 * @pw_element string $cPlaca Placa do veículo de transporte
 * @pw_element string $cUF UF da placa do veículo do transporte
 * @pw_element integer $nQtdVol Quantidade de volumes
 * @pw_element string $cEspVol Espécie dos volumes
 * @pw_element string $cMarVol Marca dos volumes
 * @pw_element string $cNumVol Numeração dos volumes
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nValFrete Valor do frete
 * @pw_element decimal $nValSeguro Valor do seguro
 * @pw_element string $cLacre Número do lacre
 * @pw_element decimal $nValOutras Valor das outras despesas acessórias
 * @pw_complex frete_upsert
 */
class frete_upsert
{
	/**
	 * Código interno da transportadora (este é o código da transportadora no Omie)
	 *
	 * @var integer
	 */
	public $nCodTransp;
	/**
	 * Código de integração da transportadora (este é o código da transportadora no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntTransp;
	/**
	 * Modalidade do frete no pedido
	 *
	 * @var string
	 */
	public $cTpFrete;
	/**
	 * Placa do veículo de transporte
	 *
	 * @var string
	 */
	public $cPlaca;
	/**
	 * UF da placa do veículo do transporte
	 *
	 * @var string
	 */
	public $cUF;
	/**
	 * Quantidade de volumes
	 *
	 * @var integer
	 */
	public $nQtdVol;
	/**
	 * Espécie dos volumes
	 *
	 * @var string
	 */
	public $cEspVol;
	/**
	 * Marca dos volumes
	 *
	 * @var string
	 */
	public $cMarVol;
	/**
	 * Numeração dos volumes
	 *
	 * @var string
	 */
	public $cNumVol;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Valor do frete
	 *
	 * @var decimal
	 */
	public $nValFrete;
	/**
	 * Valor do seguro
	 *
	 * @var decimal
	 */
	public $nValSeguro;
	/**
	 * Número do lacre
	 *
	 * @var string
	 */
	public $cLacre;
	/**
	 * Valor das outras despesas acessórias
	 *
	 * @var decimal
	 */
	public $nValOutras;
}

/**
 * Produtos do Pedido de Compra
 *
 * @pw_element string $cCodIntItem Código de integração do item do pedido de compra (este é o código do item no seu sistema)
 * @pw_element integer $nCodItem Código interno do item do pedido de compra (este é o código do item no Omie)
 * @pw_element string $cCodIntProd Código de integração do cadastro do produto (este é o código do produto no seu sistema)
 * @pw_element integer $nCodProd Código interno do cadastro do produto (este é o código do produto no Omie)
 * @pw_element string $cProduto Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
 * @pw_element string $cDescricao Descrição do item no pedido
 * @pw_element string $cNCM Código NCM do item
 * @pw_element string $cUnidade Unidade do item no pedido
 * @pw_element string $cEAN Código EAN / GTIN do item no pedido
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nQtde Quantidade do item no pedido
 * @pw_element decimal $nValUnit Valor unitário do item no pedido
 * @pw_element decimal $nDesconto Valor do desconto do item no pedido
 * @pw_element decimal $nValorIcms Valor do ICMS
 * @pw_element decimal $nValorSt Valor do ICMS ST
 * @pw_element decimal $nValorIpi Valor do IPI
 * @pw_element decimal $nValorPis Valor do PIS
 * @pw_element decimal $nValorCofins Valor do COFINS
 * @pw_element string $cObs Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cMkpAtuPv Indica que deve atualizar o preço de venda do produto no recebimento
 * @pw_element string $cMkpAtuSm Indica que deve atualizar o preço apenas se for maior que o atual
 * @pw_element decimal $nMkpPerc Percentual a ser utilizado para a atualização do preço de venda do produto
 * @pw_element integer $codigo_local_estoque Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_complex produtos_upsert
 */
class produtos_upsert
{
	/**
	 * Código de integração do item do pedido de compra (este é o código do item no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntItem;
	/**
	 * Código interno do item do pedido de compra (este é o código do item no Omie)
	 *
	 * @var integer
	 */
	public $nCodItem;
	/**
	 * Código de integração do cadastro do produto (este é o código do produto no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código interno do cadastro do produto (este é o código do produto no Omie)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
	 *
	 * @var string
	 */
	public $cProduto;
	/**
	 * Descrição do item no pedido
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Código NCM do item
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * Unidade do item no pedido
	 *
	 * @var string
	 */
	public $cUnidade;
	/**
	 * Código EAN / GTIN do item no pedido
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Quantidade do item no pedido
	 *
	 * @var decimal
	 */
	public $nQtde;
	/**
	 * Valor unitário do item no pedido
	 *
	 * @var decimal
	 */
	public $nValUnit;
	/**
	 * Valor do desconto do item no pedido
	 *
	 * @var decimal
	 */
	public $nDesconto;
	/**
	 * Valor do ICMS
	 *
	 * @var decimal
	 */
	public $nValorIcms;
	/**
	 * Valor do ICMS ST
	 *
	 * @var decimal
	 */
	public $nValorSt;
	/**
	 * Valor do IPI
	 *
	 * @var decimal
	 */
	public $nValorIpi;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $nValorPis;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $nValorCofins;
	/**
	 * Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Indica que deve atualizar o preço de venda do produto no recebimento
	 *
	 * @var string
	 */
	public $cMkpAtuPv;
	/**
	 * Indica que deve atualizar o preço apenas se for maior que o atual
	 *
	 * @var string
	 */
	public $cMkpAtuSm;
	/**
	 * Percentual a ser utilizado para a atualização do preço de venda do produto
	 *
	 * @var decimal
	 */
	public $nMkpPerc;
	/**
	 * Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
	 *
	 * @var integer
	 */
	public $codigo_local_estoque;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
}


/**
 * Rateio do Pedido de Compra por departamento
 *
 * @pw_element string $cCodDepto Código do Departamento
 * @pw_element decimal $nPerc Percentual de rateio
 * @pw_complex departamentos_upsert
 */
class departamentos_upsert
{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDepto;
	/**
	 * Percentual de rateio
	 *
	 * @var decimal
	 */
	public $nPerc;
}


/**
 * Parcelas  do Pedido de Compra.
 *
 * @pw_element integer $nParcela Número da parcela
 * @pw_element string $dVencto Data de vencimento da parcela
 * @pw_element decimal $nValor Valor da parcela
 * @pw_element integer $nDias Dias para vencimento da parcela (a partir da data de previsão de entrega)
 * @pw_element decimal $nPercent Percentual da parcela em relação ao total do pedido de compra
 * @pw_element string $cTipoDoc Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
 * @pw_complex parcelas_upsert
 */
class parcelas_upsert
{
	/**
	 * Número da parcela
	 *
	 * @var integer
	 */
	public $nParcela;
	/**
	 * Data de vencimento da parcela
	 *
	 * @var string
	 */
	public $dVencto;
	/**
	 * Valor da parcela
	 *
	 * @var decimal
	 */
	public $nValor;
	/**
	 * Dias para vencimento da parcela (a partir da data de previsão de entrega)
	 *
	 * @var integer
	 */
	public $nDias;
	/**
	 * Percentual da parcela em relação ao total do pedido de compra
	 *
	 * @var decimal
	 */
	public $nPercent;
	/**
	 * Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
	 *
	 * @var string
	 */
	public $cTipoDoc;
}


/**
 * Resposta do Upsert de um Pedido de Compra
 *
 * @pw_element integer $nCodPed Código interno do pedido de compra (este é o código do pedido no Omie)
 * @pw_element string $cCodIntPed Código de integração do pedido de compra (este é o código do pedido no seu sistema)
 * @pw_element string $cCodStatus Código do status
 * @pw_element string $cDescStatus Descrição do status
 * @pw_element string $cNumero Número do pedido de compra
 * @pw_complex com_pedido_upsert_response
 */
class com_pedido_upsert_response
{
	/**
	 * Código interno do pedido de compra (este é o código do pedido no Omie)
	 *
	 * @var integer
	 */
	public $nCodPed;
	/**
	 * Código de integração do pedido de compra (este é o código do pedido no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntPed;
	/**
	 * Código do status
	 *
	 * @var string
	 */
	public $cCodStatus;
	/**
	 * Descrição do status
	 *
	 * @var string
	 */
	public $cDescStatus;
	/**
	 * Número do pedido de compra
	 *
	 * @var string
	 */
	public $cNumero;
}

/**
 * Departamentos do Pedido de Compras
 *
 * @pw_element string $cCodDepto Código do Departamento
 * @pw_element decimal $nPerc Percentual de rateio
 * @pw_element decimal $nValor Valor do rateio
 * @pw_complex departamentos_consulta
 */
class departamentos_consulta
{
	/**
	 * Código do Departamento
	 *
	 * @var string
	 */
	public $cCodDepto;
	/**
	 * Percentual de rateio
	 *
	 * @var decimal
	 */
	public $nPerc;
	/**
	 * Valor do rateio
	 *
	 * @var decimal
	 */
	public $nValor;
}


/**
 * Frete, Transporte e Outras Despesas do Pedido de Compra
 *
 * @pw_element integer $nCodTransp Código interno da transportadora (este é o código da transportadora no Omie)
 * @pw_element string $cCodIntTransp Código de integração da transportadora (este é o código da transportadora no seu sistema)
 * @pw_element string $cTpFrete Modalidade do frete no pedido
 * @pw_element string $cPlaca Placa do veículo de transporte
 * @pw_element string $cUF UF da placa do veículo do transporte
 * @pw_element integer $nQtdVol Quantidade de volumes
 * @pw_element string $cEspVol Espécie dos volumes
 * @pw_element string $cMarVol Marca dos volumes
 * @pw_element string $cNumVol Numeração dos volumes
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nValFrete Valor do frete
 * @pw_element decimal $nValSeguro Valor do seguro
 * @pw_element string $cLacre Número do lacre
 * @pw_element decimal $nValOutras Valor das outras despesas acessórias
 * @pw_complex frete_consulta
 */
class frete_consulta
{
	/**
	 * Código interno da transportadora (este é o código da transportadora no Omie)
	 *
	 * @var integer
	 */
	public $nCodTransp;
	/**
	 * Código de integração da transportadora (este é o código da transportadora no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntTransp;
	/**
	 * Modalidade do frete no pedido
	 *
	 * @var string
	 */
	public $cTpFrete;
	/**
	 * Placa do veículo de transporte
	 *
	 * @var string
	 */
	public $cPlaca;
	/**
	 * UF da placa do veículo do transporte
	 *
	 * @var string
	 */
	public $cUF;
	/**
	 * Quantidade de volumes
	 *
	 * @var integer
	 */
	public $nQtdVol;
	/**
	 * Espécie dos volumes
	 *
	 * @var string
	 */
	public $cEspVol;
	/**
	 * Marca dos volumes
	 *
	 * @var string
	 */
	public $cMarVol;
	/**
	 * Numeração dos volumes
	 *
	 * @var string
	 */
	public $cNumVol;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Valor do frete
	 *
	 * @var decimal
	 */
	public $nValFrete;
	/**
	 * Valor do seguro
	 *
	 * @var decimal
	 */
	public $nValSeguro;
	/**
	 * Número do lacre
	 *
	 * @var string
	 */
	public $cLacre;
	/**
	 * Valor das outras despesas acessórias
	 *
	 * @var decimal
	 */
	public $nValOutras;
}

/**
 * Parcelas do Pedido de Compras
 *
 * @pw_element integer $nParcela Número da parcela
 * @pw_element string $dVencto Data de vencimento da parcela
 * @pw_element decimal $nValor Valor da parcela
 * @pw_element integer $nDias Dias para vencimento da parcela (a partir da data de previsão de entrega)
 * @pw_element decimal $nPercent Percentual da parcela em relação ao total do pedido de compra
 * @pw_element string $cTipoDoc Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
 * @pw_complex parcelas_consulta
 */
class parcelas_consulta
{
	/**
	 * Número da parcela
	 *
	 * @var integer
	 */
	public $nParcela;
	/**
	 * Data de vencimento da parcela
	 *
	 * @var string
	 */
	public $dVencto;
	/**
	 * Valor da parcela
	 *
	 * @var decimal
	 */
	public $nValor;
	/**
	 * Dias para vencimento da parcela (a partir da data de previsão de entrega)
	 *
	 * @var integer
	 */
	public $nDias;
	/**
	 * Percentual da parcela em relação ao total do pedido de compra
	 *
	 * @var decimal
	 */
	public $nPercent;
	/**
	 * Tipo de Documento.<BR>Preenchimento opcional.<BR><BR>Lista de tipos de documentos em:<BR>/api/v1/geral/tiposdoc
	 *
	 * @var string
	 */
	public $cTipoDoc;
}


/**
 * Produtos do Pedido de Compra
 *
 * @pw_element string $cCodIntItem Código de integração do item do pedido de compra (este é o código do item no seu sistema)
 * @pw_element integer $nCodItem Código interno do item do pedido de compra (este é o código do item no Omie)
 * @pw_element string $cCodIntProd Código de integração do cadastro do produto (este é o código do produto no seu sistema)
 * @pw_element integer $nCodProd Código interno do cadastro do produto (este é o código do produto no Omie)
 * @pw_element string $cProduto Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
 * @pw_element string $cDescricao Descrição do item no pedido
 * @pw_element string $cNCM Código NCM do item
 * @pw_element string $cEAN Código EAN / GTIN do item no pedido
 * @pw_element string $cUnidade Unidade do item no pedido
 * @pw_element decimal $nPesoLiq Peso líquido (Kg)
 * @pw_element decimal $nPesoBruto Peso bruto (Kg)
 * @pw_element decimal $nQtde Quantidade do item no pedido
 * @pw_element decimal $nValUnit Valor unitário do item no pedido
 * @pw_element decimal $nValMerc Valor total do produto (de mercadoria) no pedido
 * @pw_element decimal $nDesconto Valor do desconto do item no pedido
 * @pw_element decimal $nValorIcms Valor do ICMS
 * @pw_element decimal $nValorSt Valor do ICMS ST
 * @pw_element decimal $nValorIpi Valor do IPI
 * @pw_element decimal $nValorPis Valor do PIS
 * @pw_element decimal $nValorCofins Valor do COFINS
 * @pw_element decimal $nFrete Valor do frete (proporcional para o item do pedido)
 * @pw_element decimal $nSeguro Valor do seguro (proporcional para o item do pedido)
 * @pw_element decimal $nDespesas Valor das outras despesas acessórias (proporcional para o item do pedido)
 * @pw_element decimal $nValTot Valor total do item (considerando descontos, despesas e impostos)
 * @pw_element string $cObs Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
 * @pw_element string $cMkpAtuPv Indica que deve atualizar o preço de venda do produto no recebimento
 * @pw_element string $cMkpAtuSm Indica que deve atualizar o preço apenas se for maior que o atual
 * @pw_element decimal $nMkpPerc Percentual a ser utilizado para a atualização do preço de venda do produto
 * @pw_element integer $codigo_local_estoque Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
 * @pw_element string $cCodCateg Código da categoria de compra do item
 * @pw_element decimal $nQtdeRec Quantidade recebida do Item.
 * @pw_complex produtos_consulta
 */
class produtos_consulta
{
	/**
	 * Código de integração do item do pedido de compra (este é o código do item no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntItem;
	/**
	 * Código interno do item do pedido de compra (este é o código do item no Omie)
	 *
	 * @var integer
	 */
	public $nCodItem;
	/**
	 * Código de integração do cadastro do produto (este é o código do produto no seu sistema)
	 *
	 * @var string
	 */
	public $cCodIntProd;
	/**
	 * Código interno do cadastro do produto (este é o código do produto no Omie)
	 *
	 * @var integer
	 */
	public $nCodProd;
	/**
	 * Código do item no pedido (pode ser o mesmo código que aparece na NF-e do fornecedor)
	 *
	 * @var string
	 */
	public $cProduto;
	/**
	 * Descrição do item no pedido
	 *
	 * @var string
	 */
	public $cDescricao;
	/**
	 * Código NCM do item
	 *
	 * @var string
	 */
	public $cNCM;
	/**
	 * Código EAN / GTIN do item no pedido
	 *
	 * @var string
	 */
	public $cEAN;
	/**
	 * Unidade do item no pedido
	 *
	 * @var string
	 */
	public $cUnidade;
	/**
	 * Peso líquido (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoLiq;
	/**
	 * Peso bruto (Kg)
	 *
	 * @var decimal
	 */
	public $nPesoBruto;
	/**
	 * Quantidade do item no pedido
	 *
	 * @var decimal
	 */
	public $nQtde;
	/**
	 * Valor unitário do item no pedido
	 *
	 * @var decimal
	 */
	public $nValUnit;
	/**
	 * Valor total do produto (de mercadoria) no pedido
	 *
	 * @var decimal
	 */
	public $nValMerc;
	/**
	 * Valor do desconto do item no pedido
	 *
	 * @var decimal
	 */
	public $nDesconto;
	/**
	 * Valor do ICMS
	 *
	 * @var decimal
	 */
	public $nValorIcms;
	/**
	 * Valor do ICMS ST
	 *
	 * @var decimal
	 */
	public $nValorSt;
	/**
	 * Valor do IPI
	 *
	 * @var decimal
	 */
	public $nValorIpi;
	/**
	 * Valor do PIS
	 *
	 * @var decimal
	 */
	public $nValorPis;
	/**
	 * Valor do COFINS
	 *
	 * @var decimal
	 */
	public $nValorCofins;
	/**
	 * Valor do frete (proporcional para o item do pedido)
	 *
	 * @var decimal
	 */
	public $nFrete;
	/**
	 * Valor do seguro (proporcional para o item do pedido)
	 *
	 * @var decimal
	 */
	public $nSeguro;
	/**
	 * Valor das outras despesas acessórias (proporcional para o item do pedido)
	 *
	 * @var decimal
	 */
	public $nDespesas;
	/**
	 * Valor total do item (considerando descontos, despesas e impostos)
	 *
	 * @var decimal
	 */
	public $nValTot;
	/**
	 * Observação do item no pedido (elas serão impressas no pedido enviado ao fornecedor)
	 *
	 * @var string
	 */
	public $cObs;
	/**
	 * Indica que deve atualizar o preço de venda do produto no recebimento
	 *
	 * @var string
	 */
	public $cMkpAtuPv;
	/**
	 * Indica que deve atualizar o preço apenas se for maior que o atual
	 *
	 * @var string
	 */
	public $cMkpAtuSm;
	/**
	 * Percentual a ser utilizado para a atualização do preço de venda do produto
	 *
	 * @var decimal
	 */
	public $nMkpPerc;
	/**
	 * Código do Local do Estoque.<BR><BR>Preenchimento opcional.<BR><BR>Caso não informado assumirá o Local do Estoque padrão.
	 *
	 * @var integer
	 */
	public $codigo_local_estoque;
	/**
	 * Código da categoria de compra do item
	 *
	 * @var string
	 */
	public $cCodCateg;
	/**
	 * Quantidade recebida do Item.
	 *
	 * @var decimal
	 */
	public $nQtdeRec;
}


/**
 * Erro gerado pela aplicação.
 *
 * @pw_element integer $code Codigo do erro
 * @pw_element string $description Descricao do erro
 * @pw_element string $referer Origem do erro
 * @pw_element boolean $fatal Indica se eh um erro fatal
 * @pw_complex omie_fail
 */
if (!class_exists('omie_fail')) {
	class omie_fail
	{
		/**
		 * Codigo do erro
		 *
		 * @var integer
		 */
		public $code;
		/**
		 * Descricao do erro
		 *
		 * @var string
		 */
		public $description;
		/**
		 * Origem do erro
		 *
		 * @var string
		 */
		public $referer;
		/**
		 * Indica se eh um erro fatal
		 *
		 * @var boolean
		 */
		public $fatal;
	}
}
