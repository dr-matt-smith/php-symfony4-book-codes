<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product/create/{description}/{price}", name="product_create")
     */
    public function createAction($description, $price)
    {
        // create new product object
        $product = new Product();
        $product->setDescription($description);
        $product->setPrice($price);

        // persist (save/store) this object's contents to the database
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showAction($id)
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $product= $productRepository->find($id);

        // we are assuming $product is not NULL....

        $template = 'product/show.html.twig';
        $args = [
            'product' => $product
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/product", name="product_list")
     */
    public function listAction()
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();

        $template = 'product/list.html.twig';
        $args = [
            'products' => $products
        ];
        return $this->render($template, $args);
    }
}
