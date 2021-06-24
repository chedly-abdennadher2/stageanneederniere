<?php

namespace App\Controller;

use App\Entity\Option;
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

    public function initialiser(&$rep,&$manager,&$repoption)
    {
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Produit::class);
        $repoption = $doct->getRepository(Option::class);

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

        $this->initialiser($rep, $manager,$repoption);
        $request=   $request->get('searchproduit');
        $tab=    $request['options'];
        $opt=new ArrayCollection();
        $i=0;
        $search =new SearchProduit();
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
            $search->addOptions($value);
        }
        $options=$search->getOptions();
        dump($options);
        $i=0;
      foreach ($options as $clef=>$value)
      {
          $tmp[$i] =  $options[$i];
          $i++;
      }
       $result= $rep->FindByOptions($tmp);
       dump($result);


        return $this->render('produit/index.html.twig',
            [
                'produits' => $result,
            ]);



    }

}
