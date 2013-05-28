<?php

namespace DP;

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            // This defines the hostname route which forms the base
            // of each "child" route
            'departamento-pessoal' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/dp',
                    'defaults' => array(
                        'controller' => 'DP\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'convite-hora-extra' => array(
                        'type' => 'Literal',
                        'may_terminate' => true,
                        'options' => array(
                            'route' => '/convite-hora-extra',
                            'defaults' => array(
                                'controller' => 'DP\Controller\ConviteHoraExtra',
                                'action' => 'index',
                            ),
                        ),
                        'child_routes' => array(
                            'single-store' => array(
                                'type' => 'Literal',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/convite-individual',
                                    'defaults' => array(
                                        'action' => 'storesingle',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'CHEAprov' => function($sm) {
                $user = $sm->get('Auth')->getStorage()->read();
                $em = $sm->get('doctrine.entitymanager.orm_default');
               if ($user) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');

                    $convites = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.supervisor='{$user['displayname']}' and Convite.lido=0 order by Convite.idconvitehoraextra DESC");
                    $result = $convites->getResult();

                    return $result;
                }
                return 0;
            },
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'DP\Controller\Index' => 'DP\Controller\IndexController',
            'DP\Controller\ConviteHoraExtra' => 'DP\Controller\ConviteHoraExtraController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../../Base/view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../../Base/view/error/404.phtml',
            'error/index' => __DIR__ . '/../../Base/view/error/index.phtml',
            'partials/navigation' => __DIR__ . '/../view/partials/navigation.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    ),
);
