<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KnightController extends AbstractController
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/knight/{name,strength,weaponPower}", name="knight")
     */
    public function index($name, $strength, $weaponPower): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/KnightController.php',
            'name' => $name,
            'strength' => $strength,
            'weaponPower' => $weaponPower,
        ]);
    }
}
