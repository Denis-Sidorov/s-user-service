<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataTransformer\UserTransformer;
use App\Form\UserType;
use App\Model\User\User;
use App\Dto\UserDto;
use App\Model\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @param Filesystem $fs
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function list(Filesystem $fs, SerializerInterface $serializer)
    {
        $userDBPath = $this->getParameter('kernel.project_dir') . '/var/db/user';
        if (!$fs->exists($userDBPath)) {
            return $this->render('user/list.html.twig', ['users' => []]);
        }

        $users = [];
        $finder = new Finder();
        $finder->files()->in($userDBPath)->sortByModifiedTime();
        foreach ($finder as $file) {
            $users[] = $serializer->deserialize($file->getContents(), User::class, 'json');
        }

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/users/create", name="user_create")
     */
    public function createUser(Request $request, UserTransformer $transformer, UserRepository $userRepository)
    {
        $userDto = new UserDto();
        $form = $this->createForm(UserType::class, $userDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $transformer->fromDto($userDto);
            $userRepository->save($user);

            $this->addFlash('success', "User \"{$user->getName()}\" created");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
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