<?php

namespace App\Controller;
use App\Entity\Circuit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProgrammationCircuit;

class FrontofficeHomeController extends AbstractController
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {
        $em = $this->get('doctrine')->getManager();
        $programmationcircuits = $em->getRepository(ProgrammationCircuit::class)->findAll();
        dump($programmationcircuits);
        return $this->render('front/home.html.twig', [
            'programmationcircuits' => $programmationcircuits,
        ]);
    }
    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/{id}", name="circuit_show", requirements={ "id": "\d+"}, methods="GET")
     */
    public function showCircuit(Circuit $circuit)
    {
        dump($circuit);
        return $this->render('front/circuit_show.html.twig', array(
            'circuit' => $circuit,
        ));
    }
    
    
}
