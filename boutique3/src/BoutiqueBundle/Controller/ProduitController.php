<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BoutiqueBundle\Entity\Produit;
class ProduitController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        //methode 1 pour récupérer le repository:
       $repository = $this -> getDoctrine() -> getRepository(Produit::class);
       // $repository = $this -> getDoctrine() -> getRepository('BoutiqueBundle\Entity\Produit');
       $produits = $repository -> findAll();
      

        dump($produits);

       // SELECT DISTINCT Categegorie FROM produit
       $em = $this -> getDoctrine() -> getManager();
       $query = $em -> createQuery ("SELECT DISTINCT p.categorie FROM BoutiqueBundle\Entity\Produit p");
       $categories = $query -> getResult();
       

        $params = array (
            'produits' => $produits,
            'categories' => $categories,
            'title' => 'Accueil'
        );





        return $this->render('@Boutique/Produit/index.html.twig', $params);
    }
    /**
     * @Route("/categorie/{categorie}", name ="categorie")
     */
    public function categorieAction($categorie)
    {
       
        //methode 1 pour récupérer le repository:
       $repository = $this -> getDoctrine() -> getRepository(Produit::class);
    
       $produits = $repository -> findBy(['categorie' => $categorie]);

       // SELECT DISTINCT Categegorie FROM produit
       $em = $this -> getDoctrine() -> getManager();
       $query = $em -> createQuery ("SELECT DISTINCT p.categorie FROM BoutiqueBundle\Entity\Produit p");
       $categories = $query -> getResult();
      

        $params = array (
            'produits' => $produits,
            'categories' => $categories,
            'title' => 'Page catégorie : ' . $categorie 
        );

        return $this->render('@Boutique/Produit/index.html.twig', $params);
    }
    /**
     * @Route("/produit/{id}", name ="produit")
     */
    public function produitAction($id)
    {
        //methode 1 pour récupérer le repository:
       $repository = $this -> getDoctrine() -> getRepository(Produit::class);
       // $repository = $this -> getDoctrine() -> getRepository('BoutiqueBundle\Entity\Produit');
       $produit = $repository -> find($id);
        
       //methode2 :

       //$em = $this -> getDoctrine() -> getManager();
       //$produit = $em -> find(Produit::class, $id);

       //on récupère les sugestions : 
        //$suggestions = $repository -> findBy(['categorie' => $produit -> getCategorie()]);
        
        // ON récupère les suggestions avec queryBuillder, une requête créé en PHP :
        $em = $this -> getDoctrine() -> getManager();
        $query = $em -> createQueryBuilder(); // Objet QueryBuilder

        $query
            -> select('p')
            -> from(Produit::class, 'p')
            -> where('p.categorie = :categorie')
            -> orderby('p.prix', 'DESC')
            -> setParameter('categorie', $produit -> getCategorie());
        
        $suggestions = $query -> getQuery() -> getResult() ;

        // Ce query builder nous créé une requête qui s'apparenterait à ceci :
       // SELECT * FROM produit WHERE categorie = : categorie ORDER BY prix DESC
       // bindParam(':categorie',$produit -> getCategorie())

        $params = array (
            'produit' => $produit,
            'suggestions' => $suggestions,
            'title' => 'Produit : '. $produit -> getTitre()
        );
        return $this->render('@Boutique/Produit/produit.html.twig', $params);
    }

}
