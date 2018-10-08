<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use BoutiqueBundle\Entity\Membre;
use BoutiqueBundle\Entity\Produit;
use BoutiqueBundle\Entity\Commande;
use BoutiqueBundle\Entity\DetailsCommande;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use BoutiqueBundle\Form\ProduitType;
use BoutiqueBundle\Form\CommandeType;
use BoutiqueBundle\Form\MembreType;

class AdminController extends Controller{

/**
 * @Route("/admin/", name="home_admin") 
 */
public  function homeAdminAction () {}

/**
 * @Route("/admin/produit/show", name="show_produit") 
 */
public function produitShowAction()
   {
       $repository = $this -> getDoctrine() -> getRepository(Produit::class); // je veux récupérer tous les produits
       $produits = $repository -> findAll();   // équivalent du SELECT *       
       
       // SELECT DISTINCT Categorie FROM produit
       $em = $this -> getDoctrine() -> getManager();
       $query = $em -> createQuery("SELECT DISTINCT p.categorie FROM BoutiqueBundle\Entity\Produit p");
       $categories = $query -> getResult();        $params = array(

           'produits' => $produits,
           'categories' => $categories,
           'title' => 'Gestion des produits'
       );     
       return $this->render('@Boutique/admin/show_produit.html.twig', $params);

   }


/**
 * @Route("/admin/produit/add", name="add_produit") 
 */
public  function produitAddAction(Request $request) {
    $produit = new Produit;
 
    // on récupère notre formulaire 
    $form = $this -> createForm(ProduitType::class, $produit);
    
    // Je génére le formulaire (HTML,- partie visuelle )
    $formView = $form -> createView();
    
    $form -> handleRequest($request);
        
    if($form -> isSubmitted() && $form -> isValid()){
        // On verra plus tard la validation 

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($produit);

        $produit -> chargementPhoto();

        $em -> flush ();

        $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez ajouter votre produit  !');

        return $this -> redirectToRoute('show_produit');
    }
    



    $params = array( 
        'title' => 'Ajout produit',
        'produitForm' => $formView
    );
    return $this->render('@Boutique/admin/form_produit.html.twig', $params);
 }
 
/**
 * @Route("/admin/produit/update/{id}", name="update_produit") 
 */
public  function produitUpdateAction ($id, Request $request) {

    $repository = $this -> getDoctrine() -> getRepository(Produit::class);

    $produit = $repository -> find($id);

    $form = $this ->createForm(ProduitType:: class, $produit);
    // Je génére le formulaire (HTML,- partie visuelle )
    $formView = $form -> createView();
    
    $form -> handleRequest($request);
        
    if($form -> isSubmitted() && $form -> isValid()){
        // On verra plus tard la validation 

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($produit);
        $produit ->chargementPhoto();
        $em -> flush ();

        $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez modifié votre produit  !');

        return $this -> redirectToRoute('show_produit');
    }
    



    $params = array( 
        'title' => 'Ajout produit',
        'produitForm' => $formView
    );
    return $this->render('@Boutique/admin/form_produit.html.twig', $params);

}


/**
 * @Route("/admin/produit/delete/{id}", name="delete_produit") 
 */

public  function produitDeleteAction ($id, Resquest $request) {
    $em = $this -> getDoctrine() -> getManager();
    $produit = $em -> find(Produit::class, $id) ;

     
    $em -> remove($produit);
    $em -> flush();

    $session = $request -> getSession();
    $session -> getFlashBag() -> add('success','le produit n°' . $id .' a bien été supprimé');

    return $this -> redirectToRoute('show_produit');
}

//----------------------------MEMBRE -----------------------------------------



/**
 * @Route("/admin/membre/show", name="show_membre") 
 */
public function membreShowAction()
   {
       $repository = $this -> getDoctrine() -> getRepository(Membre::class); // je veux récupérer tous les membres
       $membres = $repository -> findAll();   // équivalent du SELECT *       
       
       
       $params = array(
           'membres' => $membres,
           'title' => 'Gestion des membres'
       );     
       return $this->render('@Boutique/admin/show_membre.html.twig', $params);

   }

   /**
 * @Route("/admin/membre/add", name="add_membre") 
 */
public  function membreAddAction(Request $request) {
    $passwordEncoder = $this -> get('security.password_encoder');
        $membre = new Membre;
        $membre -> setStatut(0);
        $membre -> setRole('ROLE_USER');


    

    // on récupère notre formulaire 
    $form = $this -> createForm(MembreType::class, $membre);
    
    // Je génére le formulaire (HTML,- partie visuelle )
    $formView = $form -> createView();
    
    $form -> handleRequest($request);
        
    if($form -> isSubmitted() && $form -> isValid()){
        // On verra plus tard la validation 
        $salt = substr(md5(time() ), 0, 23);
            // time() : 1545223656
            // Time() crypté en MD5 :  562HJVF53DGGD5GD2HH41HVSDIGV6D
            // On conserve du 0 au 23ème caractères : 562HJVF53DGGD5GD2HH41HVS

            $password = $passwordEncoder -> encodePassword($membre, $salt);
            $membre -> setPassword($password) -> setSalt($salt);

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($membre);

     

        $em -> flush ();

        $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez ajouter votre membre  !');

        return $this -> redirectToRoute('show_membre');
    }
    



    $params = array( 
        'title' => 'Ajout membre',
        'membreForm' => $formView
    );
    return $this->render('@Boutique/admin/form_membre.html.twig', $params);
 }


 /**
 * @Route("/admin/membre/update/{id}", name="update_membre") 
 */
public  function membreUpdateAction ($id, Request $request) {

    $repository = $this -> getDoctrine() -> getRepository(Membre::class);

    $membre = $repository -> find($id);

    $form = $this ->createForm(MembreType:: class, $membre);
    // Je génére le formulaire (HTML,- partie visuelle )
    $formView = $form -> createView();
    
    $form -> handleRequest($request);
        
    if($form -> isSubmitted() && $form -> isValid()){
        // On verra plus tard la validation 

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($membre);
        $em -> flush ();

        $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous avez modifié votre membre  !');

        return $this -> redirectToRoute('show_membre');
    }
    



    $params = array( 
        'title' => 'Ajout membre',
        'membreForm' => $formView
    );
    return $this->render('@Boutique/admin/form_membre.html.twig', $params);

}


        /**
		* @Route("/admin/membre/delete/{id}", name="delete_membre")
		*/
		
		public function deleteMembreAction($id, Request $request) {

            // On récupère le produit, via le manager... Parce qu'on va en avoir besoin pour la suppression
            $em = $this -> getDoctrine()-> getManager();
            $membre = $em -> find(Membre::class, $id);
            
            $em -> remove($membre);
            $em -> flush();
            
            $session = $request -> getSession();
            $session -> getFlashBag() -> add('success', 'Le membre n°' . $id . ' a bien été supprimé');
            
            return $this -> redirectToRoute('show_membre');
    
            }

        /**
         *@Route("Admin/membre/profil/{id}", name="profil_membre")
         */
        public function profilMembreAction($id){
            $repository = $this -> getDoctrine() -> getRepository(Membre::class);
            $membre = $repository -> find($id);

            $params = array (
                'membre' => $membre,
                'title' => 'Membre : '. $membre -> getTitre()
            );
            return $this->render('@Boutique/Admin/profil_membre.html.twig', $params);
        }

    

}

