<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product_list")
     */
    public function list()
    {
//        $em = $this->getDoctrine()->getManager();
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();

        $template = 'product/list.html.twig';
        $args = [
            'products' => $products,
        ];
        return $this->render($template, $args);

    }



    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product)
    {

        $template = 'product/show.html.twig';
        $args = [
            'product' => $product
        ];

        return $this->render($template, $args);
    }


    /**
     * @Route("/product/insert/{name}/{price}", name="product_insert")
     */
    public function insertAction($name, $price)
    {
//        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $em = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        $template = 'product/created.html.twig';
        $args = [
            'product' => $product
        ];


        return $this->render($template, $args);
    }
}
