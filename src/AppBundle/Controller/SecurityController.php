<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('userhome.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN')){
            return $this->render('@App/Security/adminhome.html.twig');

        }
        elseif ($authChecker->isGranted('ROLE_ORGANISATEUR')){
            return $this->render('@App/Security/organisateurhome.html.twig');

        }
        elseif ($authChecker->isGranted('ROLE_USER')){
            return $this->render('@App/Security/userhome.html.twig');

        }

        else{
            return $this->render('@FOSUser/Security/login.html.twig');
        }
            // ...
    }

}
