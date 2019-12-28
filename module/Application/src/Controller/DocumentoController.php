<?php
/**
 * Controller das ações envolvendo o documento (vendas)
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
}