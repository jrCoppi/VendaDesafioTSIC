<?php
/**
 * Controller das ações de base do Documento, dados e demais ações de back end
 */

namespace Application\Controller\Base;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class DocumentoControllerBase extends AbstractActionController
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
     * Cria o novo documento em base
     * @param float $vl_total_documento
     */
    public function setDocumento(
        $vl_total_documento
    ) {
        $documento = new \Application\Model\Documento();
        $documento
            ->setVlTotalDocumento(
                $vl_total_documento
            );
        $documento
            ->confirmaDocumento(0);
        $documento
            ->cancelaDocumento(0);

        $this
            ->entityManager
            ->persist($documento);

        $this
            ->entityManager
            ->flush();

        return $documento
            ->getIdDocumento();
    }

    /**
     * Atualiza a tabela de documento produto
     * TO-DO pesquisar e ajustar chave composta no doctrine
     * @param int $id_documento
     * @param int $id_produto
     */
    public function setDocumentoProduto(
        $id_documento,
        $id_produto
    ) {
        $stmt = $this
            ->entityManager
            ->getConnection()
            ->prepare(
                "INSERT IGNORE INTO  documento_produto (id_produto,id_documento) 
                values (
                    {$id_produto},
                    {$id_documento}
                )  "
            );

        $stmt->execute();
    }

    
    /**
     * Atualiza o documento
     *
     * @param int $id_documento
     * @param int $sn_documento_confirmado
     * @param int $sn_documento_cancelado
     * @param float $vl_total_documento
     */
    public function updateDocumento(
        $id_documento,
        $sn_documento_confirmado,
        $sn_documento_cancelado,
        $vl_total_documento
    ){
        $documento = new \Application\Model\Documento();
        $documento
            ->setIdDocumento(
                $id_documento
            );
        $documento
            ->setVlTotalDocumento(
                $vl_total_documento
            );
        $documento
            ->confirmaDocumento(
                $sn_documento_confirmado
            );
        $documento
            ->cancelaDocumento(
                $sn_documento_cancelado
            );

        $this
            ->entityManager
            ->merge($documento);
        $this
            ->entityManager
            ->flush();
    }
}