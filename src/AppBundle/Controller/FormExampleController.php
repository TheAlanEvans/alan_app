<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class FormExampleController extends Controller
{
    /**
     * @Route("/form")
     */
    public function formExampleAction(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();
        }
        
        return $this->render(':form-example:index.html.twig',[
            'form' => $form->createView()
        ]);
    }
}