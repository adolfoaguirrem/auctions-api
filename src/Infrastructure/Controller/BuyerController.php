<?php

namespace App\Infrastructure\Controller;

use Throwable;
use App\Application\Http\Request\BuyerRequest;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\UseCases\CreateBuyerUseCase;
use App\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BuyerController
 * @package App\Infrastructure\Controller
 * @Route("/api/buyer", name="api_buyer_")
 */
final class BuyerController extends AbstractController
{
    public function __construct(private CreateBuyerUseCase $createBuyerUseCase)
    {
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function index()
    {
        return new JsonResponse(["message" => "Buyer working !!"], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function createBuyer(BuyerRequest $request): JsonResponse
    {
        try {
            $request->validate();

            $data = $request->getContent();

            $this->createBuyerUseCase->execute($data);

            return new JsonResponse(['message' => 'Buyer created'], JsonResponse::HTTP_OK);
        } catch (ValidationException $e) {
            return new JsonResponse(['message' => 'Buyer cannot be created', 'errors' => $e->getValidationMessages()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => 'Buyer cannot be created', 'errors' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
