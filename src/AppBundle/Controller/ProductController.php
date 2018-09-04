<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    public function overviewAction(Request $request)
    {
        $products = $this->getDoctrine()->getEntityManager()->getRepository('AppBundle:Product')->findAll();

        return $this->render('AppBundle:product:overview.html.twig', ['products' => $products]);
    }

    public function addAction(Request $request){
        $product = new Product($request->get('name'), str_replace('.','', $request->get('price')));
        $product->setSku($request->get('sku'));

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush($product);

        $this->redirectToRoute('product_overview');
    }
}
