<?php
/**
 * Controller da ações envolvendo os produtos na aplicação
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProdutoController extends AbstractActionController
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

    //busca os produtos baseados num filtro
    public function getProdutoAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];

        //dados do post, decodifica json
        $arrDadosPost = json_decode($this->request->getContent());

        //verifica se veio o filtro
        if(empty($arrDadosPost) || empty($arrDadosPost->filtroproduto)) {
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Filtro não informado";

            return new JsonModel($arrRetorno);
        }

        //busca produtos na base
        $this->getProdutoFromBase(
            $arrDadosPost->filtroproduto,
            $arrRetorno
        );
        
        return new JsonModel($arrRetorno);
    }

    //Insere um novo produto na base
    public function setProdutoAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];

        //dados do post, decodifica json
        $arrDadosPost = json_decode($this->request->getContent());

        //verifica se veio o filtro
        if(empty($arrDadosPost) || empty($arrDadosPost->ds_codigo_produto)) {
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Produto não informado";

            return new JsonModel($arrRetorno);
        }

        //Faz a inserção do produto
        //TO-DO caso aconteça um erro ao inserir, setar como erro e retornar a mensagem
        $this->setProdutoBase(
            $arrDadosPost,
            $arrRetorno
        );
        
        return new JsonModel($arrRetorno);
    }

    //busca o produto da base
    private function getProdutoFromBase(
        $filtroproduto,
        &$arrRetorno
    ) {  
        try{
            //faz os filtros para encontrar o produto
            $result = $this->entityManager->createQueryBuilder();
            $listaProdutos = $result->select('p')
                    ->from('Application\Model\Produto', 'p')
                    ->where('p.ds_codigo_produto like :id')
                    ->orWhere('p.ds_produto like :id')
                    ->setParameter('id', '%'.$filtroproduto.'%')
                    ->getQuery()
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //seta no array de retorno
            $arrRetorno['dados'] = $listaProdutos;
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel recuperar os produtos da base.";
        }
    } 

    //seta o produto na base
    private function setProdutoBase(
        $arrDados,
        &$arrRetorno
    ) {
        try{
            //puxa o model do doctrine e cria um novo produto
            $produto = new \Application\Model\Produto();
            $produto->setDsCodigoProduto($arrDados->ds_codigo_produto);
            $produto->setDsProduto($arrDados->ds_produto);
            $produto->setVlProduto($arrDados->vl_produto);

            $this->entityManager->persist($produto);
            $this->entityManager->flush();
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel inserir o produto.";
        }
    }

     //busca os produtos baseados num filtro
    public function getProdutoVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = [
            'sucesso' => true,
            'mensagem' => '',
            'dados' => []
        ];

        //dados do post, decodifica json
        $arrDadosPost = json_decode($this->request->getContent());

        //verifica se veio o filtro
        if(empty($arrDadosPost) || empty($arrDadosPost->filtroproduto)) {
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Filtro não informado";

            return new JsonModel($arrRetorno);
        }

        //busca produtos na base
        $this->getProdutoVendaFromBase(
            $arrDadosPost->filtroproduto,
            $arrRetorno
        );

        return new JsonModel($arrRetorno);
    }

    //busca o produto da base
    private function getProdutoVendaFromBase(
        $filtroproduto,
        &$arrRetorno
    ) {  
        try{
            //faz os filtros para encontrar o produto
            $result = $this->entityManager->createQueryBuilder();
            $listaProdutos = $result->select('p')
                    ->from('Application\Model\Produto', 'p')
                    ->where('p.ds_codigo_produto = :id')
                    ->setParameter('id', $filtroproduto)
                    ->getQuery()
                    ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //seta no array de retorno
            $arrRetorno['dados'] = $listaProdutos;
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel recuperar os produtos da base.";
        }
    } 
}
