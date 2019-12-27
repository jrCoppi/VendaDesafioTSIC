<?php
/**
 * Controller das ações envolvendo o documento (vendas)
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DocumentoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}