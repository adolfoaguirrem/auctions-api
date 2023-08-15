<?php

namespace App\Infrastructure\Controller;

use Throwable;
use App\Application\Http\Request\BidRequest;
use App\Application\UseCases\CreateBidUseCase;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\Exception\ValidationException;
use App\Application\Service\AuctionResultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BidController
 * @package App\Infrastructure\Controller
 * @Route("/api/bid", name="api_bid_")
 */
final class BidController extends AbstractController
{

    public function __construct(
        private CreateBidUseCase $createBidUseCase,
        private AuctionResultService $auctionResultService
    ) {
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function index()
    {
        return new JsonResponse(["message" => "Bids working !!"], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function addBid(BidRequest $request): JsonResponse
    {
        try {
            $request->validate();

            $data = $request->getContent();

            $this->createBidUseCase->execute($data);

            return new JsonResponse(['message' => 'Bid created'], JsonResponse::HTTP_OK);
        } catch (ValidationException $e) {
            return new JsonResponse(['message' => 'Bid cannot be created', 'errors' => $e->getValidationMessages()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => 'Bid cannot be created', 'errors' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{productId}/result", methods={"GET"})
     */
    public function getAuctionResult(string $productId): JsonResponse
    {
        $result = $this->auctionResultService->execute($productId);

        return new JsonResponse($result, JsonResponse::HTTP_OK);
    }
}
