<?php

namespace FilmBundle\Controller;

use FilmBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
/**
 * Film controller.
 *
 */
class FilmController extends Controller
{

    /**
     * Lists all film entities.
     *
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $userrole = $user->getRoles();
        $users_id = $user->getId();
        if($userrole[0] == 'ROLE_ADMIN'){
            $em = $this->getDoctrine()->getManager();

            $films = $em->getRepository('FilmBundle:Film')->findAll();

            return $this->render('film/index.html.twig', array(
                'films' => $films,
            ));
        }
        if($userrole[0] == 'ROLE_ORGANISATEUR'){
            $em = $this->getDoctrine()->getManager();

            $films = $em->getRepository('FilmBundle:Film')->findBy(
                ['users' => $users_id]);

            return $this->render('film/index.html.twig', array(
                'films' => $films,
            ));
        }


    }

    /**
     * Creates a new film entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $userrole = $user->getRoles();

        $film = new Film();
        $form = $this->createForm('FilmBundle\Form\FilmType', $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($userrole[0] == 'ROLE_ORGANISATEUR'){
                $film->setUsers($user);

            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();
            if($userrole[0] == 'ROLE_ADMIN'){
                return $this->redirectToRoute('admin_film_show', array('id' => $film->getId()));

            }

            return $this->redirectToRoute('organisateur_film_show', array('id' => $film->getId()));
        }

        return $this->render('film/new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a film entity.
     *
     */
    public function showAction(Film $film)
    {

        $deleteForm = $this->createDeleteForm($film);
        return $this->render('film/show.html.twig', array(
            'film' => $film,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing film entity.
     *
     */
    public function editAction(Request $request, Film $film)
    {
        $user = $this->getUser();
        $userrole = $user->getRoles();

        $deleteForm = $this->createDeleteForm($film);
        $editForm = $this->createForm('FilmBundle\Form\FilmType', $film);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if($userrole[0] == 'ROLE_ADMIN'){
                return $this->redirectToRoute('admin_film_edit', array('id' => $film->getId()));

            }
            return $this->redirectToRoute('organisateur_film_edit', array('id' => $film->getId()));
        }

        return $this->render('film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a film entity.
     *
     */
    public function deleteAction(Request $request, Film $film)
    {
        $user = $this->getUser();
        $userrole = $user->getRoles();

        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();
        }
        if($userrole[0] == 'ROLE_ADMIN'){
            return $this->redirectToRoute('admin_film_index');

        }
        return $this->redirectToRoute('organisateur_film_index');
    }

    /**
     * Creates a form to delete a film entity.
     *
     * @param Film $film The film entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Film $film)
    {
        $user = $this->getUser();
        $userrole = $user->getRoles();
        if($userrole[0] == 'ROLE_ADMIN'){
            return $this->createFormBuilder()
                ->setAction($this->generateUrl('admin_film_delete', array('id' => $film->getId())))
                ->setMethod('DELETE')
                ->getForm()
                ;
        }
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organisateur_film_delete', array('id' => $film->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
