<?php

namespace DP\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Zend\Form\Annotation;
/**
 * Convitehoraextra
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @ORM\Table(name="convitehoraextra")
 * @ORM\Entity
 */
class Convitehoraextra {

    /**
     * @var integer
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="idConviteHoraExtra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $idconvitehoraextra;

    /**
     * @var \DateTime
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="dataregistro", type="date", nullable=false)
     */
    public $dataregistro;

    /**
     * @var \DateTime
     * @Annotation\Type("Zend\Form\Element\Text")
     *  @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Data de início do trabalho: "})
     * @ORM\Column(name="datainicio", type="date", nullable=false)
     */
    public $datainicio;

    /**
     * @var \DateTime
     * @Annotation\Type("Zend\Form\Element\Text")
     *  @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Data de término do trabalho: "})
     * @ORM\Column(name="datafim", type="date", nullable=false)
     */
    public $datafim;

    /**
     * @var string
     ** @Annotation\Type("Zend\Form\Element\Textarea")
     *  @Annotation\AllowEmpty(true)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Motivo: "})
     * @ORM\Column(name="motivo", type="text", nullable=false)
     */
    public $motivo;

    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    public $nome;
    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="emailsolicitante", type="string", length=45, nullable=true)
     */
    public $emailsolicitante;

    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="matricula", type="string", length=45, nullable=false)
     */
    public $matricula;

    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="aprovadoger", type="string", length=1, nullable=false)
     */
    public $aprovadoger;

    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="supervisor", type="string", length=145, nullable=true)
     */
    public $supervisor;

    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="aprovadorose", type="string", length=1, nullable=true)
     */
    public $aprovadorose;
    /**
     * @var string
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="solicitante", type="string", length=245, nullable=true)
     */
    public $solicitante;
    public function getSolicitante() {
        return $this->solicitante;
    }

    public function setSolicitante($solicitante) {
        $this->solicitante = $solicitante;
    }

    public function getSubmit() {
        return $this->submit;
    }

    public function setSubmit($submit) {
        $this->submit = $submit;
    }

        
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Enviar","class":"btn btn-success"})
     */
    public $submit;
    public function getEmailsolicitante() {
        return $this->emailsolicitante;
    }

    public function setEmailsolicitante($emailsolicitante) {
        $this->emailsolicitante = $emailsolicitante;
    }

        public function getIdconvitehoraextra() {
        return $this->idconvitehoraextra;
    }

    public function setIdconvitehoraextra($idconvitehoraextra) {
        $this->idconvitehoraextra = $idconvitehoraextra;
    }

    public function getDataregistro() {
        return $this->dataregistro->format('d/m/Y');
    }

    public function setDataregistro(\DateTime $dataregistro) {
        $this->dataregistro = $dataregistro;
    }

    public function getDatainicio() {
        return $this->datainicio->format('d/m/Y');;
    }

    public function setDatainicio(\DateTime $datainicio) {
        $this->datainicio = $datainicio;
    }

    public function getDatafim() {
        return $this->datafim->format('d/m/Y');;
    }

    public function setDatafim(\DateTime $datafim) {
        $this->datafim = $datafim;
    }

    public function getMotivo() {
        return $this->motivo;
    }

    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getAprovadoger() {
        return $this->aprovadoger;
    }

    public function setAprovadoger($aprovadoger) {
        $this->aprovadoger = $aprovadoger;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;
    }

    public function getAprovadorose() {
        return $this->aprovadorose;
    }

    public function setAprovadorose($aprovadorose) {
        $this->aprovadorose = $aprovadorose;
    }

    function __construct(EntityManager $entityManager) {
        $this->setEntityManager($entityManager);
    }

    public function store() {
        if (!$this->getIdconvitehoraextra()) {
            $this->getEntityManager()->persist($this);           
        } else {
            $this->getEntityManager()->merge($this);           
        }
         $this->getEntityManager()->flush();
    }

    public function populate(array $data) {
        $this->setDatafim($data['datafim']);
        $this->setDatainicio($data['datainicio']);
        $this->setDataregistro(new \DateTime('now'));
        $this->setMatricula($data['matricula']);
        $this->setMotivo($data['motivo']);
        $this->setNome($data['nome']);
        $this->setSupervisor($data['supervisor']);
        $this->setAprovadoger($data['aprovadoger']);
        $this->setAprovadorose($data['aprovadorose']);
        $this->setSolicitante($data['solicitante']);
        $this->setEmailsolicitante($data['emailsolicitante']);
    }

    public function getAll() {
        return $this->getEntityManager()->getRepository(get_class($this))->findAll();
    }

    public function getById($id) {
        return $this->getEntityManager()->getRepository(get_class($this))->find($id);
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager $entityManager) {

        $this->entityManager = $entityManager;
    }
}
