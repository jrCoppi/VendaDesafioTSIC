<?php
/**
 * Controller principal da aplicação
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\Base\IndexControllerBase;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
/**
     * Base do Index
     * @var Application\Controller\IndexControllerBase
     */
    private $indexBase;

    /**
     * Construtor recebe o entity manager e passa para a base
     */
    public function __construct($entityManager) 
    {
        $this->indexBase = new IndexControllerBase($entityManager);
    }

    /**
     * Pagina inicial da aplicação
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Busca os dados para o admin visualizar na tela inicial
     */
    public function getDadosAdminAction()
    {
        $arrRetorno = [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];

        try{
            //busca produtos na base
            $arrRetorno['dados'] = $this
                ->indexBase
                ->getValorTotalVenda();
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel recuperar o valor total da venda.";
        }
        
        return new JsonModel($arrRetorno);
    }
}
