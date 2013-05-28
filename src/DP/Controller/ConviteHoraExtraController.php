<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DP\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use DP\Entity\ConviteHoraExtra;
use Zend\Debug\Debug;

class ConviteHoraExtraController extends AbstractActionController {

    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction() {
        $em = $this->getEntityManager();
        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where Convite.aprovado=1  and Convite.dataregistro like '%2013-05%' order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function meAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getEntityManager();
        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.solicitante='{$as['displayname']}' and Convite.dataregistro like '%2013-05%' order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function aprovedmeAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getEntityManager();
        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.supervisor='{$as['displayname']}' and Convite.lido = 0 order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function aprovarAction() {

        $id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $con = new ConviteHoraExtra($em);
        $convite = $con->getById($id);
        $convite->setEm($em);
        $convite->setLido(1);
        $convite->setAprovado(1);
        $convite->store();
        $userdata = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $userdata['convites-hora-extra'] = count($this->getServiceLocator()->get('CHEAprov'));
        $this->getServiceLocator()->get('Auth')->getStorage()->write($userdata);
        return $this->redirect()->toRoute('convite-hora-extra/aprovedme');
    }

    public function negarAction() {

        $id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $con = new ConviteHoraExtra($em);
        $convite = $con->getById($id);
        $convite->setEm($em);
        $convite->setLido(1);
        $convite->store();
        $userdata = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $userdata['convites-hora-extra'] = count($this->getServiceLocator()->get('CHEAprov'));
        $this->getServiceLocator()->get('Auth')->getStorage()->write($userdata);
        return $this->redirect()->toRoute('convite-hora-extra/aprovedme');
    }

    public function storesingleAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();

        $afb = new AnnotationBuilder();
        $che = new ConviteHoraExtra($this->getEntityManager());
        $form = $afb->createForm($che);


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data['solicitante'] = $as['displayname'];
                $data['nome'] = $as['displayname'];
                $data['supervisor'] = $as['gerente'];
                $data['lido'] = 0;
                $data['aprovado'] = 0;

                $data['datainicio'] = implode('-', array_reverse(explode('/', $data['datainicio'])));
                $data['datafim'] = implode('-', array_reverse(explode('/', $data['datafim'])));
                $che->setDataregistro();
                $che->populate((array) $data);
                $che->store();
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function storegroupAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();

        $afb = new AnnotationBuilder();
        $che = new ConviteHoraExtra($this->getEntityManager());
        $form = $afb->createForm($che);
        $users = $this->getServiceLocator()->get('UsersPair');


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $select = $data['my-select'];
            unset($data['my-select']);
            foreach ($select as $d) {

                $data['solicitante'] = $as['displayname'];
                $data['nome'] = $d;
                $data['supervisor'] = $as['gerente'];
                $data['lido'] = 0;
                $data['aprovado'] = 0;
                $data['matricula'] = $data[str_replace(' ', '_', $d)];


                $data['datainicio'] = implode('-', array_reverse(explode('/', $data['datainicio'])));
                $data['datafim'] = implode('-', array_reverse(explode('/', $data['datafim'])));


                //  Debug::dump($data);
                $che->setDataregistro();
                $che->populate((array) $data);
                $che->store();
            }
        }
        return new ViewModel(array('form' => $form, 'users' => $users));
    }

}
