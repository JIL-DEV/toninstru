<?php

namespace App\Controller;

use App\Entity\Deal;
use App\Form\DealType;
use App\Repository\DealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DealController extends AbstractController
{

    private $dealRepository;
    private $entityManager;

    public function __construct(DealRepository $dealRepository, EntityManagerInterface $entityManager)
    {
        $this->dealRepository = $dealRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/deal", name="list_deal")
     */
    public function index()
    {
        // Get all Deals
        $deals = $this->dealRepository->findAll();

        return $this->render('deal/index.html.twig', [
            'deals' => $deals
        ]);
    }

    /**
     * @Route("/add_deal", name="add_deal")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function create_deal(Request $request){

        // Create new Deal with data form
        $deal = new Deal();
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if ($form->get("image")->getData() !== null){

                // Add image file
                $image = $form->get("image")->getData();
                $date = new \DateTime();

                $imageName = "deal_".$date->format('Y-m-d-H-i-s').".".$image->guessExtension();
                $image->move($this->getParameter('cards_folder'), $imageName);

                $deal->setImage($imageName);
            }
            else{

                // Set empty value
                $deal->setImage("");
            }

            // Add Deal in database
            $this->entityManager->persist($deal);
            $this->entityManager->flush();

            // Add notification message
            $this->addFlash("notification", "Votre offre a été créee");

            return $this->redirectToRoute("list_deal");
        }

        return $this->render('deal/index.html.twig',[
            "form" => $form->createView()
        ]);
    }

}
