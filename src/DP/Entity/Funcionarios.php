<?php

namespace DP\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionarios
 *
 * @ORM\Table(name="SGI_IRM.dbo.Funcionario")
 * @ORM\Entity
 */
class Funcionarios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Funcionario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="num_Matricula", type="string", length=10, nullable=false)
     */
    private $num_Matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Funcionario", type="string", length=145, nullable=true)
     */
    private $nom_Funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="pai", type="string", length=145, nullable=true)
     */
    private $pai;

    /**
     * @var string
     *
     * @ORM\Column(name="mae", type="string", length=145, nullable=true)
     */
    private $mae;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=245, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=15, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=45, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="emailc", type="string", length=45, nullable=true)
     */
    private $emailc;

    /**
     * @var string
     *
     * @ORM\Column(name="emailp", type="string", length=45, nullable=true)
     */
    private $emailp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nasc", type="date", nullable=true)
     */
    private $dataNasc;

    /**
     * @var string
     *
     * @ORM\Column(name="naturalidade", type="string", length=45, nullable=true)
     */
    private $naturalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidade", type="string", length=45, nullable=true)
     */
    private $nacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="escolaridade", type="string", length=45, nullable=true)
     */
    private $escolaridade;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=45, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="bl_Ativo", type="string", length=1, nullable=true)
     */
    private $bl_Ativo;



}
