<?php
/**
 * Controller da ações envolvendo os produtos na aplicação
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProdutoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
