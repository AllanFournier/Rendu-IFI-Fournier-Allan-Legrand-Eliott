<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{


    /**
     * @Route ("/biens",name="property.index")
     * @return Response
     */
    public function index()
    {
        $property = new Property();
        $property->setTitle('Sixieme bien')
            ->setSurface(339)
            ->setDescription('Un bien moyen immobilier');

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();
        $bk = $this->getDoctrine()->getRepository(Property::class) ->findAll(); ;

        return $this->render('property/index.html.twig', array('data' => $bk));
    }

    /**
     * @Route ("/biens/{id}",name="property.show")
     * @return Response
     */
    public function show($id): Response
    {
        $property = $this->getDoctrine()->getRepository(Property::class)->find($id);
        return $this->render('property/show.html.twig', ['property' => $property]);
    }
}