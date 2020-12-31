<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

namespace Rental;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Infrastructure\Controller\IndexController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'api' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/api',
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'v1' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/v1'
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'apartment' => [
                                'type'    => Literal::class,
                                'options' => [
                                    'route'    => '/apartment',
                                    'defaults' => [
                                        'controller' => Infrastructure\Controller\ApartmentController::class
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'statistics' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/:id/book',
                                            'defaults' => [
                                                'controller' => Infrastructure\Controller\ApartmentController::class,
                                                'action' => 'book'
                                            ]
                                        ],
                                    ]
                                ]
                            ],
                            'hotel' => [
                                'type'    => Literal::class,
                                'options' => [
                                    'route'    => '/hotel',
                                    'defaults' => [
                                        'controller' => Infrastructure\Controller\HotelController::class
                                    ],
                                ],
                            ],
                            'hotel-room' => [
                                'type'    => Literal::class,
                                'options' => [
                                    'route'    => '/hotel-room',
                                    'defaults' => [
                                        'controller' => Infrastructure\Controller\HotelRoomController::class
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'statistics' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/:id/book',
                                            'defaults' => [
                                                'controller' => Infrastructure\Controller\HotelRoomController::class,
                                                'action' => 'book'
                                            ]
                                        ],
                                    ]
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Infrastructure\Controller\ApartmentController::class => ReflectionBasedAbstractFactory::class,
            Infrastructure\Controller\HotelController::class => ReflectionBasedAbstractFactory::class,
            Infrastructure\Controller\HotelRoomController::class => ReflectionBasedAbstractFactory::class,
            Infrastructure\Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Application\Service\ApartmentService::class => Infrastructure\Factory\ApartmentServiceFactory::class,
            Application\Service\HotelService::class => Infrastructure\Factory\HotelServiceFactory::class,
            Application\Service\HotelRoomService::class => Infrastructure\Factory\HotelRoomServiceFactory::class,
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Domain'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Domain' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ]
];
