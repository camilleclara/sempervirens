<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/affiche/{message}", name="homepage")
     */
    public function index(Request $req)
    {
        return new Response("Le message est " . $req->get('message'));
    }

}
