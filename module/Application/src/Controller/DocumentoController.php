<?php
/**
 * Controller das ações envolvendo o documento (vendas)
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class DocumentoController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    /**
     * Constructor is used for injecting dependencies into the controller.
     */
    public function __construct($entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function updateVendaAction()
    {
        //
    }

    public function updateProdutoVendaAction()
    {
        //
    }

    public function setVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];

        //dados do post, decodifica json
        $arrDados = json_decode($this->request->getContent());

        //try{
            //puxa o model do doctrine e cria um novo produto
            $documento = new \Application\Model\Documento();
            $documento->setVlTotalDocumento($arrDados->vl_total_documento);
            $documento->confirmaDocumento(0);
            $documento->cancelaDocumento(0);

            $this->entityManager->persist($documento);
            $this->entityManager->flush();

            //atualiza a tabela de documento produto
            $documentoProduto = new \Application\Model\Documento_Produto();
            $documentoProduto->setIdDocumento($documento->getIdDocumento());
            $documentoProduto->setIdProduto($arrDados->id_produto);

            //ajustar chave composta doctrine

            $this->entityManager->persist($documentoProduto);
            $this->entityManager->flush();

            //retorna o id do documento
            $arrRetorno['dados']['id_documento'] = $documento->getIdDocumento();
        /*}  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel inserir o produto.";
        }*/
        
        return new JsonModel($arrRetorno);
    }
}