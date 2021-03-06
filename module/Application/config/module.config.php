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
            'admin' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/admin'
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'get' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/get',
                            'defaults' => [
                                'controller' => Controller\IndexController::class,
                                'action'     => 'getDadosAdmin',
                            ],
                        ],
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
                    'get-venda' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/get-venda',
                            'defaults' => [
                                'controller' => Controller\ProdutoController::class,
                                'action'     => 'getProdutoVenda',
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
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'update' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/update',
                            'defaults' => [
                                'controller' => Controller\DocumentoController::class,
                                'action'     => 'updateVenda',
                            ],
                        ],
                    ],
                    'update-produto' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/update-produto',
                            'defaults' => [
                                'controller' => Controller\DocumentoController::class,
                                'action'     => 'updateProdutoVenda',
                            ],
                        ],
                    ],
                    'set' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/set',
                            'defaults' => [
                                'controller' => Controller\DocumentoController::class,
                                'action'     => 'setVenda',
                            ],
                        ],
                    ],
                ],
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
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/produto/index' => __DIR__ . '/../view/application/produto/index.phtml',
            'application/documento/index' => __DIR__ . '/../view/application/documento/index.phtml',
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
