<?php

namespace App\Controller;


use App\Entity\Customer;
use DateTime;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use function foo\func;
use App\Repository\CustomerRepository;

class CustomerController extends AbstractController
{

    public function initialiser(&$rep,&$manager,&$repupdate)
    {
        $manager = $this->getDoctrine()->getManager();
        $doct = $this->getDoctrine();
        $rep = $doct->getRepository(Customer::class);
        $repupdate = $doct->getRepository(Customer::class);

    }

    /**
     * @Route("/customer/ajouter", name="createcustomer")
     */
    public function ajouter(): Response
    {
        $this->initialiser($rep,$manager,$repupdate);
unset ($rep);
unset ($repupdate);
         $c=new Customer();

        $c->setNom('ali');
 $c->setPrenom ( 'chedly');

        $date = new DateTime('2000-01-01');
        $c->setDateNaiss($date);
        $c->setAdresse('8 rue');
        $manager->persist($c);
        $manager->flush();



        return $this->render('customer/index.html.twig', [
            'x' => 'CustomerController',
        ]

        );
    }
    /**
     *
     * @Route("/customer/consulterparid/{id}", name="selectcustomerid")
     */

    public function rechercherparid(int $id)
{$this->initialiser($rep,$manager,$repupdate);
 unset($manager);
 unset($repupdate);

    $c = $rep->find($id);

    return $this->render('customer/contenu.html.twig',
        [
        'element' => $c,
    ]);

}
    /**
     *

     * @Route("/customer/consultertous", name="selectionnertout")
      */
    public function recherchertous()
    {$this->initialiser($rep,$manager,$repupdate);
        unset($manager);
        unset($repupdate);

        $c = $rep->findAll();
        return $this->render('customer/contenu.html.twig',
            [
                'elements' => $c,
            ]);

    }

    /**
     *
     * @Route("/customer/consulterparnom/{nom}", name="selectcustomernom")
     */

public function rechercherparnom($nom)
{
    $this->initialiser($rep,$manager,$repupdate);
    unset($manager);
    unset($repupdate);

    $doct = $this->getDoctrine();
    $rep = $doct->getRepository(Customer::class);
    $c = $rep->findBy(['nom'=> $nom] );
    return $this->render('customer/contenu.html.twig',
        [
            'elements' => $c,
        ]);

}
    /**
     *
     * @Route("/customer/mettreajour/{id}", name="mettreajour")
     */
public  function update($id)
{
    $this->initialiser($rep,$manager,$repupdate);
    unset($rep);

    $c = $repupdate->find($id);
    if (!$c)
    {
        echo"n'existe pas " ;
    }
    else
        {
          $c->setNom('reeoeopej');
         $manager->flush();
        }
    return $this->render('customer/index.html.twig',
        [
            'controller_name' => 'CustomerController',
        ]);

}
    /**
     *
     * @Route("/customer/supprimer/{id}", name="supprimer")
     */
    public  function delete($id)
    {
        $this->initialiser($rep,$manager,$repupdate);
        unset($repupdate);

        $c = $rep->find($id);
if (!$c)
{
echo"n'existe pas " ;
}
else
{
    $manager->remove($c);
    $manager->flush();
}
return $this->render('customer/index.html.twig',
    [
        'controller_name' => 'CustomerController',
    ]);

}


    /**
     *
     * @Route("/customer/consulterparidsupx/{id}", name="selectcustomeridsupx")
     */
    public function rechercherparidsupx(int $id,CustomerRepository $repository)
    {
        $c =$repository->findAllGreaterId($id);
        var_dump($c);
        return $this->render('customer/index.html.twig',
            [
                'controller_name' => 'CustomerController',
            ]);

    }

}