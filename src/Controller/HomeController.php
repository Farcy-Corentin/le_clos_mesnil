<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route ("/", name="app_home")
     * @return Response
     */
    public function index(): Response
    {
        $country = $this->getDoctrine()->getRepository(Country::class)->findOneById('FR');
        return $this->render('pages/home.html.twig', [
            "country" => $country
        ]);
    }
}
