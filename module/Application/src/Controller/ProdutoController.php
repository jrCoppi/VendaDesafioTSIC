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
        $arrRetorno['dados'] = $this->getProdutoFromBase(
            $arrDadosPost->filtroproduto
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
        $arrRetorno['dados'] = $this->setProdutoBase(
            $arrDadosPost
        );
        
        return new JsonModel($arrRetorno);
    }

    //busca o produto da base
    private function getProdutoFromBase(
        $filtroproduto
    ) {
        //buscar

        $arrProdutos = array([
            'ds_codigo_produto' => '25',
            'ds_produto' => 'teste',
            'vl_produto' => 5
        ]);

        return $arrProdutos;
    } 

    //seta o produto na base
    private function setProdutoBase(

    ) {
        return [];
    }
}
