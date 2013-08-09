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
use MailService\Service\ServiceTemplate;
use MailService\Service\MailService;

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

        $lista = $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.solicitante='{$as['displayname']}' or Convite.nome = '{$as['displayname']}'  order by Convite.idconvitehoraextra DESC");
        $list = $lista->getResult();

        return new ViewModel(array('lista' => $list));
    }

    public function aprovedmeAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getEntityManager();
        $lista = $as['displayname'] == 'Rosemari Prandini' ? $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where   Convite.aprovadorose = 0  order by Convite.idconvitehoraextra DESC") : $em->createQuery("SELECT Convite FROM DP\Entity\ConviteHoraExtra Convite where  Convite.supervisor='{$as['displayname']}' and Convite.aprovadoger = 0  order by Convite.idconvitehoraextra DESC");
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
        if ($userdat['displayname'] == 'Rosemari Prandini') {
            $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL_ROSE_APROVAR);
            $mail->addFrom('webmaster@irmserv.com.br')
                    ->addTo('prandini@irmserv.com.br')
                    ->setSubject("[convite aprovado] Convite do dia {$convite->getDataregistro()}")
                    ->setBody(array('gerente' => $convite->getSupervisor(), 'aberto' => $convite->getDataregistro(), 'sujeito' => $store['displayname'], 'inicio' => $convite->getDatainicio(), 'fim' => $convite->getDatafim(), 'motivo' => $convite->getMotivo()));


            $mail->send();
            $convite->setAprovadorose(1);
        } else {
            $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL_GESTOR_APROVAR);
            $mail->addFrom('webmaster@irmserv.com.br')
                    ->addTo($userdat['email'])
                    ->setSubject("[convite individual] Convite do dia {$convite->getDataregistro()}")
                    ->setBody(array('gerente' => $store['displayname'], 'aberto' => $convite->getDataregistro(), 'sujeito' => $store['displayname'], 'inicio' => $convite->getDatainicio, 'fim' => $convite->getDatafim(), 'motivo' => $convite->getMotivo()));


            $mail->send();
            $convite->setAprovadoger(1);
        }



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
 $auth = $this->getServiceLocator()->get('Auth')->getStorage();
   $userdat = $auth->read();
        $id = $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $con = new Convitehoraextra($em);
        $convite = $con->getById($id);
        $convite->setEntityManager($em);

        if ($userdat['displayname'] == 'Rosemari Prandini') {
            $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL_ROSE_NEGAR);
            $mail->addFrom('webmaster@irmserv.com.br')
                    ->addTo($userdat['email'])
                    ->setSubject("[convite negado] Convite do dia {$convite->getDataregistro()}")
                    ->setBody(array('gerente' => $convite->getSupervisor(), 'aberto' => $convite->getDataregistro(), 'sujeito' => $store['displayname'], 'inicio' => $convite->getDatainicio(), 'fim' => $convite->getDatafim(), 'motivo' => $convite->getMotivo()));


            $mail->send();
            $convite->setAprovadorose(2);
        } else {
            $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL_GESTOR_NEGAR);
            $mail->addFrom('webmaster@irmserv.com.br')
                    ->addTo($userdat['email'])
                    ->setSubject("[convite negado] Convite do dia {$convite->getDataregistro()}")
                    ->setBody(array('gerente' => $store['displayname'], 'aberto' => $convite->getDataregistro(), 'sujeito' => $store['displayname'], 'inicio' => $convite->getDatainicio, 'fim' => $convite->getDatafim(), 'motivo' => $convite->getMotivo()));


            $mail->send();
            $convite->setAprovadoger(2);
        }

        
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

        $date = new \DateTime('now');
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
                $inicio = $data['datainicio'];
                $fim = $data['datafim'];
                $data['datainicio'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datainicio']))));
                $data['datafim'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datafim']))));
                $store = $this->getServiceLocator()->get('Auth')->getStorage()->read();
                $che->populate((array) $data);
                $che->store();
                $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL);
                $mail->addFrom('webmaster@irmserv.com.br')
                        ->addTo($store['email'])
                        ->setSubject("[convite individual] Convite do dia {$date->format('d/m/Y')}")
                        ->setBody(array('gerente' => $store['gerente'], 'aberto' => $date->format('d/m/Y'), 'sujeito' => $store['displayname'], 'inicio' => $inicio, 'fim' => $fim, 'motivo' => $data['motivo']));


                $mail->send();
                $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_INDIVIDUAL_GESTOR_APROVAR);
                $mail->addFrom('webmaster@irmserv.com.br')
                        ->addTo($store['gerente-mail'])
                        ->setSubject("[convite individual] Convite do dia {$date->format('d/m/Y')}")
                        ->setBody(array('gerente' => $store['gerente'], 'aberto' => $date->format('d/m/Y'), 'sujeito' => $store['displayname'], 'inicio' => $inicio, 'fim' => $fim, 'motivo' => $data['motivo']));


                $mail->send();
                return $this->redirect()->toRoute('convite-hora-extra/me');
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function storegroupAction() {
        $as = $this->getServiceLocator()->get('Auth')->getStorage()->read();
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative');
        $date = new \DateTime('now');
        $afb = new AnnotationBuilder();
        $che = new ConviteHoraExtra($this->getEntityManager());
        $form = $afb->createForm($che);
        $comp = array();
        $users = $this->getServiceLocator()->get('UsersDPPair');
        $i = 0;

        foreach ($users['name'] as $u) {
            $dadossgiquery = $em->createQuery("SELECT func.nom_Funcionario as nome,func.num_Matricula as matricula  FROM DP\Entity\Funcionarios func where func.nom_Funcionario like '{$u}' and   func.bl_Ativo=1 and func.num_Matricula<>0 ");
            if ($dadossgiquery->getResult()) {
                $estado = $dadossgiquery->getResult();
                $email = isset($users['email'][$i]) ? $users['email'][$i] : '';
                $comp[$estado[0]['matricula'] . '-' . $email] = $estado[0]['nome'];
            }
            $i++;
        }


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $data['datainicio'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datainicio']))));
            $data['datafim'] = new \DateTime(implode('-', array_reverse(explode('/', $data['datafim']))));
            $select = $data['my-select'];
            unset($data['my-select']);
            $nomes = array();
            $inicio = $data['datainicio'];
            $fim = $data['datafim'];
            $emails = array();
            foreach ($select as $func) {
                list($matricula, $email, $nome) = explode('-', $func);
                $nomes[] = $nome;
                $emails[] = $email;

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
            foreach ($emails as $e) {
                $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_COLETIVO);
                $mail->addFrom('webmaster@irmserv.com.br')
                        ->addTo($e)
                        ->setSubject("[convite coletivo] Convite do dia {$date->format('d/m/Y')}")
                        ->setBody(array('gerente' => $as['gerente'], 'aberto' => $date->format('d/m/Y'), 'sujeito' => $as['displayname'], 'inicio' => $inicio, 'fim' => $fim, 'motivo' => $data['motivo'], 'nomes' => implode('<br/>', $nomes)));
                $mail->send();
            }

            $mail = new MailService($this->getServiceLocator(), ServiceTemplate::DP_CONVITE_COLETIVO_GESTOR_APROVAR);
            $mail->addFrom('webmaster@irmserv.com.br')
                    ->addTo($as['gerente-mail'])
                    ->setSubject("[convite coletivo] Convite do dia {$date->format('d/m/Y')}")
                    ->setBody(array('gerente' => $as['gerente'], 'aberto' => $date->format('d/m/Y'), 'sujeito' => $as['displayname'], 'inicio' => $inicio, 'fim' => $fim, 'motivo' => $data['motivo'], 'nomes' => implode('<br/>', $nomes)));
            $mail->send();
            return $this->redirect()->toRoute('convite-hora-extra/me');
        }
        return new ViewModel(array('form' => $form, 'users' => $comp));
    }

}
