<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'produto' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/produto',
                    'defaults' => [
                        'controller' => Controller\ProdutoController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'get-produto' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/get',
                            'defaults' => [
                                'controller' => Controller\ProdutoController::class,
                                'action'     => 'getProduto',
                            ],
                        ],
                    ],
                    'set-produto' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/set',
                            'defaults' => [
                                'controller' => Controller\ProdutoController::class,
                                'action'     => 'setProduto',
                            ],
                        ],
                    ],
                ],
            ],
            'documento' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/documento',
                    'defaults' => [
                        'controller' => Controller\DocumentoController::class,
                        'action'     => 'index',
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\ProdutoController::class => Controller\Factory\ProdutoControllerFactory::class,
            Controller\DocumentoController::class => Controller\Factory\DocumentoControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/produto/index' => __DIR__ . '/../view/application/produto/index.phtml',
            'application/documento/index' => __DIR__ . '/../view/application/documento/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . "/src/Application/Model"
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application\Model' => 'my_annotation_driver'
                ]
            ]
        ]
    ]
];
