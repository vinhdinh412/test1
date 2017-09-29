<?php
/// src/AppBundle/Controller/SecurityController.php
namespace AppBundle\Controller;
use AppBundle\Entity\datalogin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils )
    {
         // get the login error if there is one
    $error = $authUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authUtils->getLastUsername();
 // 1) build the form
        //$user = new datalogin();
      
    return $this->render('form/newform2.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
    }
}