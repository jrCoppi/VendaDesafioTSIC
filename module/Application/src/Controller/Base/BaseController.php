<?php
/**
 * Controller base da aplicação
 */

namespace Application\Controller\Base;

use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
    protected $em;

    public function __construct() {
        //$this->em = $em;
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new BaseController($container->get('Doctrine\ORM\EntityManager'));
    }
}
