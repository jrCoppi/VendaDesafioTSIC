<?php
/**
 * Controller das ações de base do Index, dados e demais ações de back end
 */

namespace Application\Controller\Base;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexControllerBase extends AbstractActionController
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
     * Busca o valor total das vendas
     */
    public function getValorTotalVenda(
    ) {
        $stmt = $this
            ->entityManager
            ->getConnection()
            ->prepare(
                "SELECT 
                    ROUND(SUM(vl_total_documento), 2) as vl_total_venda
                FROM
                    documento
                where
                    sn_documento_confirmado = 1 "
            );

        $stmt->execute();

        return $stmt->fetchAll();
    }
}