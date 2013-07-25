<?php

namespace DP;

use Zend\Config\Config;
use Zend\Debug\Debug;

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'acl' => array(
        'DP' => array(
            'TI' => array(
                'DP\Controller\Index:index',
                'DP\Controller\ConviteHoraExtra:index',
                'DP\Controller\ConviteHoraExtra:exportar',
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RH - ADP' => array(
                'DP\Controller\Index:index',
                'DP\Controller\ConviteHoraExtra:exportar',
                'DP\Controller\ConviteHoraExtra:index',
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'CONTROLADORIA' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'ALMOXARIFADO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'COMPRAS' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'DIRETORIA' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'FABRICAÇÃO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'FINANCEIRO - CONTÁBIL' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'FISCAL' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'LOGÍSTICA' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'OCTG - ADMINISTRATIVO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'OCTG - INSPEÇÃO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'OCTG - MACHINE SHOP' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'OCTG - VÁLVULAS' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'OPERACIONAL - OFFSHORE' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'PROJETOS ESPECIAIS' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'QUALIDADE' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RELATÓRIO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RH' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RH - ADP' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RH - GT' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'RH - T&D' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'SMS' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'TRANSPORTE' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'PLANEJAMENTO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
            'JURIDICO' => array(
                'DP\Controller\ConviteHoraExtra:me',
                'DP\Controller\ConviteHoraExtra:aprovedme',
                'DP\Controller\ConviteHoraExtra:aprovar',
                'DP\Controller\ConviteHoraExtra:negar',
                'DP\Controller\ConviteHoraExtra:storegroup',
                'DP\Controller\ConviteHoraExtra:storesingle',
            ),
        ),
    ),
    'router' =>
    array(
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
                            'exportar' => array(
                                'type' => 'Literal',
                                'may_terminate' => true,
                                'options' => array(
                                    'route' => '/export',
                                    'defaults' => array(
                                        'action' => 'exportar',
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

                if (isset($user['displayname'])) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');

                    $convites = $em->createQuery("SELECT Convite FROM DP\Entity\Convitehoraextra Convite where  Convite.supervisor like '{$user['displayname']}' and Convite.aprovadoger = 0  order by Convite.idconvitehoraextra DESC");
                    $result = $convites->getResult();

                    return count($result);
                }
                if (isset($user['displayname']) && $user['displayname'] == 'Rosemari Prandini') {
                    $em = $sm->get('doctrine.entitymanager.orm_default');

                    $convites = $em->createQuery("SELECT Convite FROM DP\Entity\Convitehoraextra Convite where   Convite.aprovadorose = 0  order by Convite.idconvitehoraextra DESC");
                    $result = $convites->getResult();

                    return count($result);
                }
                return 0;
            },
            'FuncionarioPair' => function($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_alternative');
                $estado = new \DP\Entity\Funcionarios($em);
                $estadoarray = array();
                foreach ($estado->getAll() as $e) {
                    $estadoarray[$e->getIdfuncionarios()] = $e->getNome();
                }
                return $estadoarray;
            },
            'UsersDPPair' => function($sm) {
                $em = $sm->get('doctrine.entitymanager.orm_alternative');
                $ldap = $sm->get('Ldap');
                $config = $sm->get('Config');
                $user = $sm->get('Auth')->getStorage()->read();
                $conf = new Config($config['ldap-config']);
                
                $result = $ldap->search("(&(objectClass=user)(memberof=CN={$user['departamento']},OU=Grupos,OU=IRM,DC=irmservices,DC=com))", $conf->server->baseDn, \Zend\Ldap\Ldap::SEARCH_SCOPE_SUB);

                $companheiros = array();
                foreach ($result as $item) {
                    $companheiros[] = $item['displayname'][0];
                }
                return $companheiros;
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
        'strategies' => array(
            'ViewJsonStrategy',
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
            ),
//            __NAMESPACE__ . '_driver_orm_alternative' => array(
//                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//                'cache' => 'array',
//                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
//            ),
//            'orm_alternative' => array(
//                'drivers' => array(
//                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver_alternative'
//                )
//            ),
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),
);
