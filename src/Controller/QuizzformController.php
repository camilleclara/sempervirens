<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzformController extends AbstractController
{
    /**
     * @Route("/quizzform/dd", name="quizzform-dumpanddie")
     */
    public function ddFormulaire()
    {
        //instanciation du repository de base, prééxistant dans symfony
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);
        $repA =$em->getRepository(Reponse::class);

        $reponses = $repA->findAll();
        $questions = $repQ->findAll();

        return $this->render('quizzform/index.html.twig', ['reponses'=>$reponses, 'questions'=>$questions]);
    }
        /**
     * @Route("/quizzform/dd", name="quizzform-dumpanddie")
     */
    public function afficherFormulaire()
    {
        //instanciation du repository de base, prééxistant dans symfony
        $em = $this->getDoctrine()->getManager();
        $repQ = $em->getRepository(Question::class);
        $questions = $repQ->findAll();

       
    }
    /**
     * @Route("/quizzform/traiter", name="quizzform-traiter")
     */
    public function traiterFormulaire(Request $req)
    {
        $input = $req->request->get('input');
        return $this->render('quizzform/resultform.html.twig', [
            'input' => $input,
        ]);
    }
}
