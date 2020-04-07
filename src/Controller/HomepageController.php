<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', []);
    }
    /**
     * @Route("/sign/in", name="sign_in")
     */
    public function getSignInForm()
    {
        return $this->render('homepage/sign_in.html.twig');
    }
    /**
     * @Route("/sign/up", name="sign_up")
     */
    public function getSignUpForm()
    {
        return $this->render('homepage/sign_up.html.twig');

    }
    /**
     * @Route("/register", name="register_user")
     */
    public function register(Request $req, SessionInterface $session)
    {

        $pseudo = $req->get('pseudo');
        $password = $req->get('password');
        $mail = $req->get('mail');
        $nom = $req->get('nom');
        $prenom = $req->get('prenom');

        $em = $this->getDoctrine()->getManager();
        $user = new Utilisateur();

        $user->setPseudo($pseudo);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setPassword($password);
        $user->setMail($mail);

        $session->set('user', $user);
        $session->set('page', 1);
        
        $em->persist($user);
        $em->flush();

        $session->set('page', 0);

        return $this->redirect("/quizz");

    }
    // /**
    //  * @Route("/quizz/{page}", name="quizz_me")
    //  */
    // public function quizz(SessionInterface $session, Request $req)
    // {
    //     $page = $req->get("page");
    //     return $this->render('homepage/quizz.html.twig', ['page'=>$page]);

    // }

    /**
     * @Route("/quizz", name="quizz_me_again")
     */
    public function quizzAgain(SessionInterface $session, Request $req)
    {
        $page = $session->get("page");
        $session->set("page", $page + 1);
        return $this->render('homepage/quizz.html.twig', ['page'=>$page]);

    }
    /**
     * @Route("/my/answer", name="dealing_answers")
     */
    public function displayAnswerForm(Request $req)
    {
        $answer = $req->get('firstQ');
        return $this->render('homepage/answer.html.twig', ['answer'=>$answer]);

    }

}
