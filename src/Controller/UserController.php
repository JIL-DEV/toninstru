<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class UserController extends AbstractController
{

    private $userRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/users", name="list_users")
     */
    public function index()
    {
        // Get all Users
        $users = $this->userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
    * @Route("/register", name="app_register")
    * @param Request $request
    * @param UserPasswordEncoderInterface $passwordEncoder
    * @param GuardAuthenticatorHandler $guardHandler
    * @param UserAuthenticator $userAuthenticator
    * @return RedirectResponse|Response
    */
    public function create_user(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        UserAuthenticator $userAuthenticator
    ){

        // Redirect if a User is log
        if ($this->getUser()){
            return $this->redirectToRoute("home");
        }

        // Create new User with data form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Encode password User
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // Add User in database
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $userAuthenticator,
                "app_user_provider"
            );
        }

        return $this->render('user/form.html.twig',[
            "form" => $form->createView()
        ]);

    }
}


















