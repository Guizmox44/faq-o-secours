<?php


namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use AppBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
    public function signinAction(Request $request) {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $this->getDoctrine()->getRepository(Role::class)->findOneBy(['code' => 'ROLE_USER']);

            $user->setRole($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('user/signin.html.twig', [
            'form' => $form->createView()
        ]);
    }
}