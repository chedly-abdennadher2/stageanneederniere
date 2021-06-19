<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
class HomeController extends AbstractController
{



    public  function index() :Response
     {
         return new Response ($this->render('base.html.twig'));
     }
    public  function gotableau() :Response
    {
        return new Response ($this->render('pages/home.html.twig'));
    }
public function gocustomer( ):Response
{
    return new Response ($this->render('customer/index.html.twig'));

}
public function gosearch()
{
    return new Response ($this->render('customer/search.html.twig'));


}
}

