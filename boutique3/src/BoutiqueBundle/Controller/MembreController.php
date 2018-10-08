<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BoutiqueBundle\Entity\Membre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use BoutiqueBundle\Form\MembreType;

class MembreController extends Controller{
    

     /**
     * @Route("/connexion/", name="connexion")
     */
    public function connexionAction(){
        $params = array( 
            'title' => 'Connexion'
        );
        return $this->render('@Boutique/Membre/connexion.html.twig', $params);

    }
    /**
     * @Route("/profil/", name="profil")
     */
    public function profilAction(Request $request){

        $security = $this -> get('security.token_storage');
        $token = $security -> getToken();
        $user = $token -> getUser ();

        $params= array(
            'title' => 'Profil de '. $user->getUsername()
        );
        return $this -> render('@Boutique/Membre/profil.html.twig', $params);
    }

    /**
     * @Route("membre/update/{id}")
     *  
     */
        public function membreUpdateAction($id){

            $em = $this -> getDoctrine() -> getManager();
            $membre = $em -> find(Membre::class, $id) ;

            $membre -> setPrenom('Mohammed') ;
            
            
            
            $em -> persist($membre);
            $em -> flush();

            return new Response("Ok, le membre id:". $id ." a été modifié");
        }
    
    /**
     * 
     * @Route("membre/delete/{id}")
     */

     public function membreDeleteAction($id){
        $em = $this -> getDoctrine() -> getManager();
        $membre = $em -> find(Membre::class, $id) ;

         
        $em -> remove($membre);
        $em -> flush();

        return new Response("Ok, le membre id:". $id ." a été supprimé");

     }



}