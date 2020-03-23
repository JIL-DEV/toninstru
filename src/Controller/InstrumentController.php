<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Repository\InstrumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{

    private $instrumentRepository;
    private $entityManager;

    public function __construct(InstrumentRepository $instrumentRepository, EntityManagerInterface $entityManager)
    {
        $this->instrumentRepository = $instrumentRepository;
        $this->entityManager = $entityManager;
    }

    /**
    * @Route("/nstrument", name="list_instruments")
    * @param Request $request
    * @return Response
    */
    public function create_instrument(Request $request){

        // Create new Instrument with data form
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            // Add Instrument in database
            $this->entityManager->persist($instrument);
            $this->entityManager->flush();

            // Add notification message
            $this->addFlash("notification", "Instrument " . $instrument->getName() . " a été ajouté");

            return $this->redirectToRoute("list_instruments");
        }

        // Get all Instruments
        $instruments = $this->instrumentRepository->findAll();

        return $this->render('instrument/index.html.twig',[
            "form" => $form->createView(),
            "instruments" => $instruments
        ]);
    }
}
