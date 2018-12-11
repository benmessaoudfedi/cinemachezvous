<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("admin/user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="admin_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $userroles = array("ROLE_ORGANISATEUR","ROLE_ADMIN");
        $em = $this->getDoctrine()->getManager();
        $repe = $em->getRepository('AppBundle:User');
        $qb = $repe->createQueryBuilder('u');
        $query = $qb->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"' . $userroles[0] . '"%')
            ->getQuery();
        $organisateurs = $query->getResult();

        $userrole = array("ROLE_USER");
        $qb1 = $repe->createQueryBuilder('u');
        $query1 = $qb1->where('u.roles not LIKE :roles')
            ->setParameter('roles', '%"' . $userroles[0] . '"%')

            ->andWhere('u.roles not LIKE :role')
            ->setParameter('role', '%"' . $userroles[1] . '"%')

            ->getQuery();
        $users = $query1->getResult();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
            'organisateurs'=>$organisateurs
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="admin_user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {

        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }
}
