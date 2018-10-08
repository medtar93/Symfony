<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile; 

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_produit;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=20)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=20)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=20)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=5)
     */
    private $taille;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="string", length=5)
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    // Pas d'annotation, car on veut pas le mapper
    private $file; 


    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;


    /**
     * Get id_produit
     *
     * @return int
     */
    public function getId_produit()
    {
        return $this->id_produit;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Produit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Produit
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Produit
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Produit
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set taille
     *
     * @param string $taille
     *
     * @return Produit
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set public
     *
     * @param string $public
     *
     * @return Produit
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Produit
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }


    // Getter et setter de File notre objet Photo uploadé
    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = NULL){
        $this -> file = $file;

        return $this; 
    }

    public function chargementPhoto(){

        if(!$this -> file){
            return; 
        }

        $nom_photo = $this -> file ->getClientOriginalName();
        // On récupère le nom original de la photo ($_FILES['photo']['name'])

        $new_nom_photo = $this -> renameFile($nom_photo);

        $this -> photo = $new_nom_photo; 

        $this -> file -> move($this -> photoDir(), $new_nom_photo);
        // photoDIR() est notre fonction qui retourne le chemin des photos, et $new_nom_photo est le nom de la photo enregistré en BDD

    }

    public function photoDir(){
        return __DIR__ . '/../../../web/photo';
    }

    public function renameFile($name){
        return 'photo_' . time() . '_' . rand(1, 9999) . '_' . $name;
        // return 'photo_1500000000_7548_thirt.jpg'
    }



}

