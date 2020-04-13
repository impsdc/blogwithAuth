<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/user", name="seeUser")
     */
    public function user()
    {
        $pdo = $this->getDoctrine()->getManager();
        $user = $pdo->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $user,
        ]);
    }

    /**
     * @Route("/editRole/{id}", name="editRole")
     */
    public function editRole(User $user = null)
    {   
        if($user == null){
            return $this->redirectToRoute('pays');
        }
        if(in_array('ROLE_AUTHEUR', $user->getRoles()) ){
            $user->setRoles(['ROLE_USER']);
        }
        else{
            $user->setRoles( ['ROLE_USER', 'ROLE_AUTHEUR' ]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash("sucess", "Role modifié");

        return $this->redirectToRoute('editRole');
    }
}
