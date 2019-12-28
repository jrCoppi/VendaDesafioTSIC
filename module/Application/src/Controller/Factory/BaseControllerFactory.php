<?php
/**
 * Factory da base controler
 * Responsavel por instanciar os serviços:
 *  - Doctrine
 */
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\Base\BaseController;

class BaseControllerFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new BaseController($container->get('Doctrine\ORM\EntityManager'));
    }
}