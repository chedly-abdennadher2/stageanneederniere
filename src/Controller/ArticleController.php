<?php
namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route ("/article",name="Article_index")
     * @return Response
     */
    public function index(): Response
    {
        return new Response ("les biens");
    }
    /**
     * @Route ("/article/{id}/{nom}",name="Article_test")
     * @return Response
     */
public function test($id,$nom)
{

    return new Response ('mon id='.$id.'mon nom='.$nom);
}


}