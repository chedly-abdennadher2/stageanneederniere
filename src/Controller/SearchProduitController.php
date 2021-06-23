<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\SearchProduit;
use App\Form\SearchproduitType;
use Doctrine\Common\Collections\ArrayCollection;
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
use App\Repository\ProduitRepository;


class SearchProduitController extends AbstractController
{

    public function initialiser(&$rep,&$manager)
    {
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Produit::class);
    }


    /**
     * @Route("/search/produit", name="search_produit")
     */

    public function index (Request &$request) :Response
    {
        $p =new SearchProduit();
        $form =$this->createForm(SearchproduitType::class,$p, [
            'action'=>$this->generateUrl('search'),
            'method'=>'GET',
        ]);
        return $this->render('produit/search.html.twig', [

            'form' => $form->createView(),
        ]);

    }


    /**
     * @Route("/search/produitparoption", name="search")
     */
    public function search(Request $request,PaginatorInterface $paginator)
    {

        $this->initialiser($rep, $manager);
        $request=   $request->get('searchproduit');
        $tab=    $request['option'];
        $search =new SearchProduit ();
        $opt=new ArrayCollection();

        $i=0;
        foreach ($tab as $clef=>$value)

        {

            switch ($value)
            {
                case 1:
                    {
                        $opt[$i]='manger';
                        break;
                    }

                    case 2:

                        {
                            $opt[$i]='armé';
                            break;
                        }
                        case 3:
                            {
                                $opt[$i]='abc';
                                break;
                            }

            }

            $i++;
        }
        foreach ($opt as $clef=>$value)
        {
            $search->addOption($value);
        }
        $options=$search->getOptions();
        dump($options);
        $p=new ArrayCollection();
       $p = $rep->findBy(['options'=> $options] );
        dump($p);
       die;
       /*
        $resultat = $paginator->paginate(
            $c, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );


        return $this->render('search/resultat.html.twig',
            [
                'elements' => $resultat,
            ]);
*/

        return $this->render('pages/index.html.twig', [
            'controller_name' => 'SearchProduitController',
        ]);

    }

}
