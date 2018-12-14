<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function redirectAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('FilmBundle:Film')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $films,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)/*page number*/
        ) ;

        $authChecker = $this->container->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN')){
            return $this->render('@App/Security/adminhome.html.twig', array(
                'films' => $pagination,

            ));

        }
        elseif ($authChecker->isGranted('ROLE_ORGANISATEUR')){
            return $this->render('@App/Security/organisateurhome.html.twig', array(
                'films' => $pagination,

            ));

        }
        elseif ($authChecker->isGranted('ROLE_USER')){


            return $this->render('@App/Security/userhome.html.twig', array(
                'films' => $pagination,

            ));

        }

        else{
            return $this->render('@FOSUser/Security/login.html.twig');
        }
            // ...
    }

}
