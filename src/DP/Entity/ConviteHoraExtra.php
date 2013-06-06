<?php

namespace DP\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Doctrine\ORM\EntityManager;
use \DateTime;
/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @ORM\Entity 
 * @ORM\Table(name="ConviteHoraExtra")
 * */
class ConviteHoraExtra {

    private $em = null;

    /**
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(name="idConvitehoraextra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")

     */
    public $idconvitehoraextra;

    /**
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\AllowEmpty(true)
     * @ORM\Column(type="date")
     */
    public $dataregistro;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Data de inicio do trabalho : "})
     * @ORM\Column(type="date")
     */
    public $datainicio;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Data de termino do trabalho : "})
     * @ORM\Column(type="date")
     */
    public $datafim;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\AllowEmpty(true)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Nome: "})
     * @ORM\Column(type="string")
     */
    public $nome;
    /**
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(type="string")
     */
    public $solicitante;

    public function getSolicitante() {
        return $this->solicitante;
    }

    public function setSolicitante($solicitante) {
        $this->solicitante = $solicitante;
    }

        /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"Digits", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Matrícula "})
     * @ORM\Column(type="string")
     */
    public $matricula;

    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"1"}})
     * @Annotation\Options({"label":"Motivo "})
     * @ORM\Column(type="string")
     */
    public $motivo;

    /**
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\AllowEmpty(true)
     * @ORM\Column(type="string")
     */
    public $supervisor;

    /**
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(type="boolean")
     */
    public $aprovado;

    /**
     * @Annotation\AllowEmpty(true)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @ORM\Column(type="boolean")
     */
    public $lido;

    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Enviar","class":"btn btn-success","id":"submit"})
     */
    public $submit;

    public function __construct(EntityManager $em) {
        $this->setEm($em);
    }

    public function populate(array $data) {
        $this->setAprovado($data['aprovado']);
        $this->setDatafim($data['datafim']);
        $this->setDatainicio($data['datainicio']);
       
        $this->setIdconvitehoraextra($data['idconvitehoraextra']);
        $this->setLido($data['lido']);
        $this->setMatricula($data['matricula']);
        $this->setMotivo($data['motivo']);
        $this->setNome($data['nome']);
        $this->setSupervisor($data['supervisor']);
        $this->setSolicitante($data['solicitante']);
    }

    public function getIdconvitehoraextra() {
        return $this->idconvitehoraextra;
    }

    public function setIdconvitehoraextra($idconvitehoraextra) {
        $this->idconvitehoraextra = $idconvitehoraextra;
    }

    public function getDataregistro() {
        return $this->dataregistro instanceof DateTime ? $this->dataregistro->format('d/m/Y'):"";
    }

    public function setDataregistro() {
        $this->dataregistro = new DateTime('now');
    }

    public function getDatainicio() {
        return $this->datainicio instanceof DateTime ? $this->datainicio->format('d/m/Y'):'';
    }

    public function setDatainicio($datainicio) {
        $this->datainicio = new DateTime($datainicio);
    }

    public function getDatafim() {
        return $this->datafim instanceof DateTime ? $this->datafim->format('d/m/Y'):'';
    }

    public function setDatafim($datafim) {
        $this->datafim = new DateTime($datafim);
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

    public function getMotivo() {
        return $this->motivo;
    }

    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;
    }

    public function getAprovado() {
        return $this->aprovado;
    }

    public function setAprovado($aprovado) {
        $this->aprovado = $aprovado;
    }

    public function getLido() {
        return $this->lido;
    }

    public function setLido($lido) {
        $this->lido = $lido;
    }

    public function getSubmit() {
        return $this->submit;
    }

    public function setSubmit($submit) {
        $this->submit = $submit;
    }

    public function getAll() {
        return $this->getEm()->getRepository(get_class($this))->findAll();
    }

    public function getById($id) {
        return $this->getEm()->getRepository(get_class($this))->find($id);
    }

    public function getEm() {
        return $this->em;
    }

    public function setEm(EntityManager $em) {
        $this->em = $em;
    }

    public function store() {
        if (!$this->getIdconvitehoraextra()) {
            $this->getEm()->persist($this);
            $this->getEm()->flush();
        } else {
            $this->getEm()->merge($this);
            $this->getEm()->flush();
        }
    }

}
