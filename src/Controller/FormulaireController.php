<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\ClientsType;
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

class FormulaireController extends AbstractController
{

    public function initialiser(&$rep,&$manager,&$repupdate)
    {
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Customer::class);
        $repupdate = $doct->getRepository(Customer::class);

    }

    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function genererformajout( Request $request): Response
    {
        $this->initialiser($rep,$manager,$repupdate);
        unset ($rep);
        unset($repupdate);
        $c=new Customer();
        $form =$this->createForm(ClientsType::class);
        $form->handleRequest($request);

        if (($form->isSubmitted())&&($form->isValid()))
        {
        $manager->persist($c);
        $manager->flush();
        }
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
