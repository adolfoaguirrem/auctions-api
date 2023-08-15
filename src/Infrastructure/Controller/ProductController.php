<?php

namespace App\Infrastructure\Controller;

use Throwable;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\Http\Request\ProductRequest;
use App\Application\Exception\ValidationException;
use App\Application\UseCases\CreateProductUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProductController
 * @package App\Infrastructure\Controller
 * @Route("/api/product", name="api_product_")
 */
final class ProductController extends AbstractController
{
    public function __construct(private CreateProductUseCase $createProductUseCase)
    {
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function index()
    {
        return new JsonResponse(["message" => "Products working !!"], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function createProduct(ProductRequest $request): JsonResponse
    {
        try {

            $request->validate();

            $data = $request->getContent();

            $this->createProductUseCase->execute($data);

            return new JsonResponse(['message' => 'Product created'], JsonResponse::HTTP_OK);
        } catch (ValidationException $e) {
            return new JsonResponse(['message' => 'Product cannot be created', 'errors' => $e->getValidationMessages()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => 'Product cannot be created', 'errors' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
