<?php
/**
 * Controller das ações envolvendo o documento (vendas)
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Controller\Base\DocumentoControllerBase;

class DocumentoController extends AbstractActionController
{
    /**
     * Base do Documento
     * @var Application\Controller\DocumentoControllerBase
     */
    private $documentoBase;

    /**
     * Construtor recebe o entity manager e passa para a base
     */
    public function __construct($entityManager) 
    {
        $this->documentoBase = new DocumentoControllerBase($entityManager);
    }

    // Tela de venda
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Atualiza dados de uma venda
     */
    public function updateVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();

        //dados do post, decodifica json
        $arrDados = $this
            ->getDadosFromPost();

        try{
            //Atualiza a tabela de documento
            $this
                ->documentoBase
                ->updateDocumento(
                    $arrDados->id_documento,
                    $arrDados->sn_documento_confirmado,                    
                    $arrDados->sn_documento_cancelado,              
                    $arrDados->vl_total_documento              
                );     
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel atualizar o documento.";
        }
        
        return new JsonModel(
            $arrRetorno
        );
    }

    /**
     * Atualiza os produtos e o total de uma venda
     */
    public function updateProdutoVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();

        //dados do post, decodifica json
        $arrDados = $this
            ->getDadosFromPost();

        try{
            //Atualiza a tabela de documento produto
            $this
                ->documentoBase
                ->setDocumentoProduto(
                    $arrDados->id_documento,
                    $arrDados->id_produto                    
                );

            //Atualiza a tabela de documento
            $this
                ->documentoBase
                ->updateDocumento(
                    $arrDados->id_documento,
                    $arrDados->sn_documento_confirmado,                    
                    $arrDados->sn_documento_cancelado,
                    $arrDados->vl_total_documento                    
                );     
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel atualizar o documento.";
        }
        
        return new JsonModel(
            $arrRetorno
        );
    }

    /**
     * Insere uma nova venda
     */
    public function setVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();

        //dados do post, decodifica json
        $arrDados = $this
            ->getDadosFromPost();

        try{
            //cria um novo documento
            $id_documento = $this
                ->documentoBase
                ->setDocumento(
                    $arrDados->vl_total_documento
                );

            //Atualiza a tabela de documento produto
            $this
                ->documentoBase
                ->setDocumentoProduto(
                    $id_documento,
                    $arrDados->id_produto                    
                );

            //retorna o id do documento
            $arrRetorno['dados']['id_documento'] = $id_documento;
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel inserir o documento.";
        }
        
        return new JsonModel(
            $arrRetorno
        );
    }

    /**
     * Retorna o retorno padrão desta controller
     */
    private function getRetornoPadrao() {
        return [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];
    }

    /**
     * Retorna os dados do post
     */
    private function getDadosFromPost() {
        return json_decode(
            $this
                ->request
                ->getContent()
        );
    }
}