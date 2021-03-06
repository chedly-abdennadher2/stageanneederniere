<?php

namespace App\Controller;

use App\Contact\Notification\ContactNotification;
use App\Entity\Contact;
use App\Entity\Produit;
use App\Form\ContactformType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {

        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request,ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $options=   $produit->getOptions();
            $size=$options->count();
            for ( $i=0;$i<($size/2)-1;$i++)
            {
                $produit->addNewOption($options[$i]);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');

        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET","POST"})
     */
    public function show(Produit $produit,ProduitRepository $produitRepository,Request $request,ContactNotification $contactNotification): Response
    {
    $contact =new Contact();
    $contact->setProd($produit);
        $form = $this->createForm(ContactformType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("success","votre email a bien ??t?? envoy??");


           $contactNotification->notify($contact);
            return $this->redirectToRoute("produit_show",["id"=>$produit->getId()]);
        }
            return $this->render('produit/show.html.twig', [
            'form' => $form->createView(),
                'produit'=>$produit
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit,ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $contact =new Contact();
        $contact->setProd($produit);

        $form->handleRequest($request);
        $form2 = $this->createForm(ContactformType::class, $contact);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

           return $this->redirectToRoute('produit_index');

        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'form2'=> $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
}
