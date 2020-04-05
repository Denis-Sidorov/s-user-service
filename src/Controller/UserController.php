<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->redirectToRoute("user_list");
    }

    /**
     * @Route(
     *     "/users/list",
     *     name="user_list"
     * )
     * @return Response
     */
    public function list()
    {
        return $this->render('user/list.html.twig', [
            'users' => [
                'Василий Пупки',
                'John Doe',
                'Геннадий Петрович'
            ],
        ]);
    }

    /**
     * @Route("/users/create", name="user_create")
     */
    public function createPage()
    {
        return $this->render('user/create.html.twig');
    }

    /**
     * @Route("/users/store", name="user_store")
     */
    public function store()
    {
        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function all()
    {
        return $this->json([
            'Василий Пупки',
            'John Doe',
            'Геннадий Петрович'
        ]);
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function create()
    {
        return new Response("User created", Response::HTTP_CREATED);
    }
}