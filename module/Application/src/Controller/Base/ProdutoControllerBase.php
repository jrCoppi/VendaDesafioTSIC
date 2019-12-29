<?php
/**
 * Controller das ações de base do Produto, dados e demais ações de back end
 */

namespace Application\Controller\Base;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProdutoControllerBase extends AbstractActionController
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

    /**
     * Busca os produtos da base
     * @param string $filtroproduto
     */
    public function getListaProdutos(
        $filtroproduto
    ) {
        $result = $this
            ->entityManager
            ->createQueryBuilder();

        return $result
            ->select('p')
            ->from('Application\Model\Produto', 'p')
            ->where('p.ds_codigo_produto like :id')
            ->orWhere('p.ds_produto like :id')
            ->setParameter('id', '%'.$filtroproduto.'%')
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
     * Busca um produto
     * @param string $filtroproduto
     */
    public function getProduto(
        $filtroproduto
    ) {
        $result = $this
            ->entityManager
            ->createQueryBuilder();

        return $result
            ->select('p')
            ->from('Application\Model\Produto', 'p')
            ->where('p.ds_codigo_produto = :id')
            ->setParameter('id', $filtroproduto)
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }

    /**
     * Cria o novo documento em base
     * @param string $ds_codigo_produto
     * @param string $ds_produto
     * @param float $vl_produto
     */
    public function setProduto(
        $ds_codigo_produto,
        $ds_produto,
        $vl_produto
    ) {
        $produto = new \Application\Model\Produto();
        $produto
            ->setDsCodigoProduto(
                $ds_codigo_produto
            );
        $produto
            ->setDsProduto(
                $ds_produto
            );
        $produto
            ->setVlProduto(
                $vl_produto
            );

        $this
            ->entityManager
            ->persist($produto);

        $this
            ->entityManager
            ->flush();

        return $produto
            ->getIdProduto();
    }
}