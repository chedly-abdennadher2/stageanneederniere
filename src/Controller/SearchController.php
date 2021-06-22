<?php

namespace App\Controller;
use Knp\Component\Pager\PaginatorInterface;

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
    public function initialiser(&$rep,&$manager,&$repupdate)
    {
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Customer::class);
    }

    /**
     * @Route("/formulairesearch", name="search")
     */
public function index (Request &$request) :Response
{
    $c =new CustomerFind();
    $form =$this->createForm(RechercheType::class,$c, [
        'action'=>$this->generateUrl('submit'),
        'method'=>'GET',
    ]);
    return $this->render('customer/search.html.twig', [

            'form' => $form->createView(),
        ]);

}

    /**
     * @Route("/search", name="submit")
     */

    public function search( Request $request,PaginatorInterface $paginator): Response
    {
        $this->initialiser($rep, $manager, $repupdate);


            $prix = $request->get('prix');
            $c =new Customer();
            $c = $rep->findBy(['prixtotal' => $prix]);

        $resultat = $paginator->paginate(
            $c, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );


        return $this->render('search/resultat.html.twig',
            [
                'elements' => $resultat,
            ]);


    }

}
