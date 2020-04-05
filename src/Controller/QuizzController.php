<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

class QuizzController extends AbstractController
{
    public function getAnswersOf($questionId){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Reponse::class);
        $reponses = $rep->findBy(['id'=>$questionId]);
        return $reponses;
    }
    /**
     * @Route("/quizz/questions", name="quizzQuestions")
     */
    public function index()
    {
        //instanciation du repository de base, prééxistant dans symfony
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Question::class);
        $questions = $rep->findAll();
        return $this->render('quizz/index.html.twig', ['questions'=>$questions]);
    }
    /**
     * @Route("/quizz/test", name="quizz")
     */
    public function getQandA()
    {
        //instanciation du repository de base, prééxistant dans symfony
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Question::class);
        $q = $rep->findOneBy(['id'=>1]);
        $question = $q->getTexte();

        $r = $q->getReponses();
        $reponses = [];
        for ($i = 0; $i < count($r)-1; $i++){
           $new = $r[$i]->getTexte();
           $reponses[] = $new;
        }
        return $this->render('quizz/index.html.twig', ['reponses'=>$reponses, 'question'=>$question]);
    }
}
