<?php
/**
 * Controller da ações envolvendo os produtos na aplicação
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Controller\Base\ProdutoControllerBase;

class ProdutoController extends AbstractActionController
{
    /**
     * Base do Produto
     * @var Application\Controller\ProdutoControllerBase
     */
    private $produtoBase;

    /**
     * Construtor recebe o entity manager e passa para a base
     */
    public function __construct($entityManager) 
    {
        $this->produtoBase = new ProdutoControllerBase($entityManager);
    }

    /**
     *  Tela de Produto
     */ 
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * busca os produtos baseados num filtro
     */
    public function getProdutoAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();

        //dados do post, decodifica json
        $arrDadosPost = $this
            ->getDadosFromPost();

        //verifica se os dados do post são validos
        $isPostValido = $this
            ->isPostValido(
                $arrRetorno,
                $arrDadosPost
            );

        if($isPostValido == false){
            return new JsonModel($arrRetorno);
        }

        try{
            //busca produtos na base
            $arrRetorno['dados'] = $this
                ->produtoBase
                ->getListaProdutos(
                    $arrDadosPost->filtroproduto
                );
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel recuperar os produtos da base.";
        }
        
        return new JsonModel($arrRetorno);
    }

    //busca os produtos baseados num filtro
    public function getProdutoVendaAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();

        //dados do post, decodifica json
        $arrDadosPost = $this
            ->getDadosFromPost();

        //verifica se os dados do post são validos
        $isPostValido = $this
            ->isPostValido(
                $arrRetorno,
                $arrDadosPost
            );
        
        if($isPostValido == false){
            return new JsonModel($arrRetorno);
        }

        try{
            //busca produtos na base
            $arrRetorno['dados'] = $this
                ->produtoBase
                ->getProduto(
                    $arrDadosPost->filtroproduto
                );
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel recuperar os produtos da base.";
        }
        
        return new JsonModel($arrRetorno);
    }

    //Insere um novo produto na base
    public function setProdutoAction()
    {
        //padrão de retorno para a aplicação
        $arrRetorno = $this
            ->getRetornoPadrao();
    
        //dados do post, decodifica json
        $arrDadosPost = $this
            ->getDadosFromPost();
    
        //verifica se os dados do post são validos
        $isPostValido = $this
            ->isPostValido(
                $arrRetorno,
                $arrDadosPost,
                false
            );
        
        if($isPostValido == false){
            return new JsonModel($arrRetorno);
        }

        try{
            //Faz a inserção do produto
            $arrRetorno['dados'] = $this
                ->produtoBase
                ->setProduto(
                    $arrDadosPost->ds_codigo_produto,
                    $arrDadosPost->ds_produto,
                    $arrDadosPost->vl_produto
                );
        }  catch (\Exception $e){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Não foi possivel inserir o produto.";
        }

        return new JsonModel($arrRetorno);
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
     * Verificar se o post é valido
     * @param array $arrRetorno
     * @param array $arrDadosPost
     * @param boolean $isFiltro
     */
    private function isPostValido(
        &$arrRetorno,
        $arrDadosPost,
        $isFiltro = true
    ) {
        if(empty($arrDadosPost) == true){
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Filtro não informado";

            return false;
        }

        if($isFiltro == true){
            //verifica se veio o filtro de produto
            if(empty($arrDadosPost->filtroproduto) == true) {
                $arrRetorno['sucesso'] = false;
                $arrRetorno['mensagem'] = "Filtro não informado";

                return false;
            }

            return true;
        }
        
        //verifica se veio o código do produto
        if(empty($arrDadosPost->ds_codigo_produto) == true) {
            $arrRetorno['sucesso'] = false;
            $arrRetorno['mensagem'] = "Filtro não informado";

            return false;
        }

        return true;
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
