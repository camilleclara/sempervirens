<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    public function getAnswersOf($questionId){
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Reponse::class);
        $reponses = $rep->findBy(['id'=>$questionId]);
        return $reponses;
    }
    /**
     * @Route("/trolilol", name="patata")
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
     * @Route("jhvhv", name="potato")
     */
    public function quizz(Request $req)
    {
        $num = $req->get('question');
        //instanciation du repository de base, prééxistant dans symfony
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Question::class);
        $q = $rep->findOneBy(['id'=>$num]);
        $question = $q->getTexte();

        $r = $q->getReponses();
        $reponses = [];
        for ($i = 0; $i < count($r); $i++){
           $reponses[$r[$i]->getPoints()] = $r[$i]->getTexte();
        }
        dd($question, $reponses);
        return $this->render('quizz/index.html.twig', ['reponses'=>$reponses, 'question'=>$question]);
    }

}
