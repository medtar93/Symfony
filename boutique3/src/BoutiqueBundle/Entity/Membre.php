<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface; 
use FOS\UserBundle\Model\User as BaseUser;
/**
 * Membre
 *
 * @ORM\Table(name="membre")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\MembreRepository")
 */
class Membre extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_membre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20)
     */
    protected $prenom;

   
    protected $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=20)
     */
    protected $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    protected $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50)
     */
    protected $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer")
     */
    protected $statut;


    // public function __construct(){
    //     $this -> statut = 0; 
    //     //$this -> setStatut(0);
    //     $this -> date_enregistrement = new \DateTime; 
    // }


//-------------------------------------------------------------


    /**
     * Get id_membre
     *
     * @return int
     */
    public function getId_membre()
    {
        return $this->id_membre;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Membre
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    
  
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Membre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Membre
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Membre
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Membre
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Membre
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Membre
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Membre
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }



}

