<?php

namespace App\Controller;
use App\Entity\Customer;
use App\Entity\CustomerFind;
use App\Form\ClientsType;
use App\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormView;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\HttpFoundation\Request;

use DateTime;
use DateTimeInterface;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use function foo\func;
use App\Repository\CustomerRepository;
use App\Controller\CustomerController;

class SearchController extends AbstractController
{
    /**
     * @Route("/formulairesearch", name="search")
     */
public function index () :Response
{
    $this->initialiser($rep,$manager,$repupdate,$form,$c);

    return $this->render('customer/search.html.twig', [

            'form' => $form->createView()

        ]);

}
    public function initialiser(&$rep,&$manager,&$repupdate,&$form,&$c)
    {
        $control=new CustomerController();
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Customer::class);
        $repupdate = $doct->getRepository(Customer::class);
        $c=new CustomerFind();

        $form =$this->createForm(RechercheType::class,$c);

    }

    /**
     * @Route("/formulairesearch", name="submit")
     */

    public function search( Request $request,float $prix): Response
    {
        $this->initialiser($rep,$manager,$repupdate,$form,$c);
        unset($repupdate);
        $form->handleRequest($request);
        $prix=$c->getPrix();
        if (($form->isSubmitted())&&($form->isValid()))
        {
            $c = $rep->findBy(['prixtotal'=> $prix] );
            return $this->render('customer/index.html.twig',
                [
                    'elements' => $c,
                ]);


    }


}
