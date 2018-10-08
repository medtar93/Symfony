<?php

namespace BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use BoutiqueBundle\Form\MembreType;
use BoutiqueBundle\Entity\Membre;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/inscription/", name="inscription")
     */

    public function inscriptionAction(Request $request){
        
        $passwordEncoder = $this -> get('security.password_encoder');
        $membre = new Membre;
        $membre -> setStatut(0);
        $membre -> setRole('ROLE_USER');


        $form = $this -> createForm(MembreType::class, $membre);
        
        // Je génére le formulaire (HTML,- partie visuelle )
        $formView = $form -> createView();

        $form -> handleRequest($request);
            
        if($form -> isSubmitted() && $form -> isValid()){
            
            $salt = substr(md5(time() ), 0, 23);
            // time() : 1545223656
            // Time() crypté en MD5 :  562HJVF53DGGD5GD2HH41HVSDIGV6D
            // On conserve du 0 au 23ème caractères : 562HJVF53DGGD5GD2HH41HVS

            $password = $passwordEncoder -> encodePassword($membre, $salt);
            $membre -> setPassword($password) -> setSalt($salt);
            // on met dans l'objet $membre le nouveau password (crypté) et le salt (généré aléatoirement) afin que ces deux valeurs soient enregistrés en BDD.

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($membre);
            $em -> flush ();

            $request -> getSession() -> getFlashBag() -> add('success', 'Félicitations, vous êtes inscrit !');

            return $this -> redirectToRoute('connexion');
        }
        



        $params = array( 
            'title' => 'Inscription',
            'membreForm' => $formView
        );
        return $this->render('@Boutique/Membre/inscription.html.twig', $params);
     }

     /**
      * @Route("/connexion/", name="connexion")
      */

      public function connexionAction(Request $request){
        
        $auth= $this -> get('security.authentication_utils');

        $error = $auth -> getLastAuthenticationError();
        $lastUsername = $auth -> getLastUsername();

        $session = $request -> getSession();

        if(!empty($error)) {
            $session-> getFlashBag() -> add('error', 'Identifiants incorrects');
        }

        $params= array(
            'lastusername' => $lastUsername,
            'title' => 'Connexion'
        );

        return $this -> render('@Boutique/Membre/connexion.html.twig', $params); 



      }

    /**
    * @Route("/deconnexion/", name="deconnexion")
    */

    public function deconnexionAction() {
        // Il faut juste que la route existe pour que SF prenne le relais sur les fonctionalités 
    }
      


}
