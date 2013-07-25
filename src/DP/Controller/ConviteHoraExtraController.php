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
use DP\Entity\Convitehoraextra;
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

        $mespass = new \DateTime();
        $now = $mespass->format("Y-m") . '-20';
        $mes = $mespass->sub(new \DateInterval('P1M'))->format('Y-m') . '-21';

        $em = $this->getEntityManager();

        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where Convite.dataregistro between '{$mes}' and '{$now}' and Convite.aprovadoger=1 and Convite.aprovadorose=1 order by Convite.idconvitehoraextra DESC");
        //$lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.aprovadoger=1 and Convite.aprovadorose=1 order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function exportarAction() {
        $mespass = new \DateTime();
        $now = $mespass->format("Y-m") . '-20';
        $mes = $mespass->sub(new \DateInterval('P1M'))->format('Y-m') . '-21';

        $em = $this->getEntityManager();
        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where Convite.dataregistro between '{$mes}' and '{$now}' and Convite.aprovadoger=1 and Convite.aprovadorose=1 order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();
        $lines[] = array('Matricula', 'Colaborador', 'Data de solicitacao', 'Inicio da tarefa', 'Termino da tarefa');
        foreach ($list as $l) {
            $lines[] = array($l->getMatricula(), $l->getNome(), $l->getDataregistro(), $l->getDatainicio(), $l->getDatafim());
        }
        $newlines = array();
        for ($i = 0; $i < count($lines); $i++) {
            $newlines[$i] = implode(';', $lines[$i]);
        }
        $export = "convites-de-hora-extra-" . date('d-m-Y') . ".csv";
        $fp = fopen($export, 'w');

        foreach ($lines as $fields) {
            fputcsv($fp, $fields);
        }


        $content = file_get_contents($export);
        $response = $this->getResponse();
        $response->setContent($content);

        $headers = $response->getHeaders();
        $headers->clearHeaders()
                ->addHeaderLine('Content-Type', 'application/vnd.ms-excel')
                ->addHeaderLine('Content-Disposition', "attachment; filename={$export}")
                ->addHeaderLine('Content-Length', filesize('file.csv'));
        $response->setHeaders($headers);
        return $response;
    }

    public function meAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getEntityManager();

        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.solicitante='{$as['displayname']}'  order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function aprovedmeAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getEntityManager();
        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.supervisor='{$as['displayname']}' and Convite.aprovadoger = 0  order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function aprovarAction() {

        $id = $this->params()->fromRoute('id');
        $auth = $this->getServiceLocator()->get('Auth')->getStorage();
        $em = $this->getEntityManager();
        $con = new Convitehoraextra($em);
        $convite = $con->getById($id);
        $convite->setEntityManager($em);
        $userdat = $auth->read();
        $userdat['displayname'] == 'Rosemari Prandini' ? $convite->setAprovadorose(1) : $convite->setAprovadoger(1);


        $convite->store();

        $userdata = $auth->read();
        $user = array();
        $user['displayname'] = $userdata['displayname'];
        $user['email'] = $userdata['email'];
        $user['departamento'] = $userdata['departamento'];
        $user['gerente-mail'] = $userdata['gerente-mail'];
        $user['convites-hora-extra'] = $userdata['convites-hora-extra'];
        $user['gerente'] = $userdata['gerente'];

        $user['convites-hora-extra'] = $this->getServiceLocator()->get('CHEAprov');
        $auth->write($user);

        $this->redirect()->toRoute('convite-hora-extra/aprovedme');
    }

    public function negarAction() {

        $id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $con = new ConviteHoraExtra($em);
        $convite = $con->getById($id);
        $convite->setEm($em);
        $convite->setLido(1);
        $convite->store();
        $auth = $this->getServiceLocator()->get('Auth')->getStorage();
        $userdata = $auth->read();
        $user = array();
        $user['displayname'] = $userdata['displayname'];
        $user['email'] = $userdata['email'];
        $user['departamento'] = $userdata['departamento'];
        $user['gerente-mail'] = $userdata['gerente-mail'];
        $user['convites-hora-extra'] = $userdata['convites-hora-extra'];
        $user['gerente'] = $userdata['gerente'];

        $user['convites-hora-extra'] = $this->getServiceLocator()->get('CHEAprov');
        $auth->write($user);

        $this->redirect()->toRoute('convite-hora-extra/aprovedme');
    }

    public function storesingleAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
//
        $auth = $this->getServiceLocator()->get('Auth');
        $userdata = $auth->getStorage()->read();
        $em_alt = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative');
        $dadossgiquery = $em_alt->createQuery("SELECT func.nom_Funcionario as nome,func.num_Matricula as matricula  FROM DP\Entity\Funcionarios func where func.nom_Funcionario like '{$userdata['displayname']}' and func.bl_Ativo=1 and func.num_Matricula<>0");


        $dadossgi = $dadossgiquery->getResult();


        $afb = new AnnotationBuilder();
        $che = new Convitehoraextra($this->getEntityManager());
        $form = $afb->createForm($che);


//
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {

                $data['nome'] = $as['displayname'];
                $data['solicitante'] = $as['displayname'];
                $data['supervisor'] = $as['gerente'];
                $data['lido'] = 0;
                $data['aprovadoger'] = 0;
                $data['aprovadorose'] = 0;
                $data['matricula'] = $dadossgi[0]['matricula'];
                $data['datainicio'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datainicio']))));
                $data['datafim'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datafim']))));

                $che->populate((array) $data);
                $che->store();
                return $this->redirect()->toRoute('convite-hora-extra/me');
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function storegroupAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative');

        $afb = new AnnotationBuilder();
        $che = new ConviteHoraExtra($this->getEntityManager());
        $form = $afb->createForm($che);
        $comp = array();
        $users = $this->getServiceLocator()->get('UsersDPPair');
        foreach ($users as $u) {
            $dadossgiquery = $em->createQuery("SELECT func.nom_Funcionario as nome,func.num_Matricula as matricula  FROM DP\Entity\Funcionarios func where func.nom_Funcionario like '{$u}' and   func.bl_Ativo=1 and func.num_Matricula<>0 ");
            if ($dadossgiquery->getResult()) {
                $estado = $dadossgiquery->getResult();

                $comp[$estado[0]['matricula']] = $estado[0]['nome'];
            }
        }


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $data['datainicio'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datainicio']))));
            $data['datafim'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datafim']))));
            $select = $data['my-select'];
            unset($data['my-select']);

            foreach ($select as $func) {
                list($matricula, $nome) = explode('-', $func);
                $che2 = new ConviteHoraExtra($this->getEntityManager());
                $data['solicitante'] = $as['displayname'];
                $data['nome'] = $nome;
                $data['matricula'] = $matricula;
                $data['supervisor'] = $as['gerente'];

                $data['aprovadoger'] = 0;
                $data['aprovadorose'] = 0;



                $che2->populate((array) $data);
                $che2->store();
            }
            return $this->redirect()->toRoute('convite-hora-extra/me');
        }
        return new ViewModel(array('form' => $form, 'users' => $comp));
    }

}
