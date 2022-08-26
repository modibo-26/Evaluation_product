<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/}", name="app_cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/}", name="index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $cardList = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            $cardList[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
            $total += $product->getPrice() * $quantity;
        }

        return $this->render(
            'cart/index.html.twig',
            compact('cardList', 'total')
        );
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(SessionInterface $session, Request $request, $id): Response
    {
        $cart = $session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id] ++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
        return $this->redirectToRoute('app_cart_index');
    }
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(SessionInterface $session, Request $request, $id): Response
    {
        $cart = $session->get('cart', []);
        if ($cart[$id] > 1) {
            $cart[$id] -- ;
        } else {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);
        return $this->redirectToRoute('app_cart_index');
    }
}
