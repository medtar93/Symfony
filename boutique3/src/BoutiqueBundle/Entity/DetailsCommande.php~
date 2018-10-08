<?php

namespace BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailsCommande
 *
 * @ORM\Table(name="details_commande")
 * @ORM\Entity(repositoryClass="BoutiqueBundle\Repository\DetailsCommandeRepository")
 */
class DetailsCommande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_details_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDetailsCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=true)
     */
    private $idCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=true)
     */
    private $idProduit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;


}

