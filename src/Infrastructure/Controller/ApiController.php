<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ApiController
 * @package App\Infrastructure\Controller
 * @Route("/api", name="api_")
 */
final class ApiController extends AbstractController
{
    public function __construct() {
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        return new JsonResponse(["message" => "api working !!"], JsonResponse::HTTP_OK);
    }

    
}
