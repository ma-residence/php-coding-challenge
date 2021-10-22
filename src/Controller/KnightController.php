<?php

namespace App\Controller;

use App\Entity\Knight;
use App\Handler\addKnightDataObject;
use App\Handler\KnightHandler;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class KnightController extends AbstractController
{
    private LoggerInterface $logger;
    private KnightHandler $knightHandler;

    /**
     * @param LoggerInterface $logger
     * @param KnightHandler $knightHandler
     */
    public function __construct(LoggerInterface $logger
        , KnightHandler $knightHandler
    )
    {
        $this->logger = $logger;
        $this->knightHandler = $knightHandler;
    }

    private function handleInvalidRequest(
          ?string $message=Knight::API_INVALID_PAYLOAD
        , ?string $error=Knight::API_MESSAGE_JSON_ONLY
        , $data=null
        , ?int $status=Knight::API_STATUS_400
    ) :JsonResponse
    {
        return $this->json([
            'message' => $message,
            'error' => $error,
            'data' => $data ?? Request::createFromGlobals()->getContent(),
            'code' => $status,
        ], $status);
    }

    /**
     * We accept only Json queries
     * @param Request $request
     * @return bool
     */
    private function isValidRequest(Request $request) :bool
    {
        return $request->getContentType() === 'json';
    }

    /**
     * @Route("/knight"
     * , name="addKnight"
     * , methods={"POST"}
     * )
     */
    public function add(Request $request): JsonResponse
    {
        $this->logger->info($request);

        /*json only allowed*/
        if (!$this->isValidRequest($request)) {
            return $this->handleInvalidRequest();
        }

        $data = $request->getContent();
        //todo: implement a custom denormalizer

        try {
            $addKnightDataObject = addKnightDataObject::getInstanceFromJson($data);
            $knight = $this->knightHandler->post($addKnightDataObject);

            return $this->json([
                'message' => Knight::API_ADD_MESSAGE_SUCCESS,
                'error' => null,
                'data' => $knight,
                'code' => Knight::API_STATUS_201,
            ], Knight::API_STATUS_201);

        } catch (Throwable $exception) {
            $this->logger->error(Knight::API_GET_ERROR_NOT_FOUND);
            $this->logger->error($exception->getCode());
            $this->logger->error($exception->getMessage());

            return $this->handleInvalidRequest(
                Knight::API_GET_ERROR_NOT_FOUND,
                $exception->getMessage(),
                $data,
                Knight::API_STATUS_400,
            );
        }
    }

    /**
     * @Route("/knight/{id}"
     * , name="getKnight"
     * , methods={"GET"}
     * , defaults={"id"=null})
     */
    public function fetch($id, Request $request) :JsonResponse
    {
        $this->logger->info($request);

        if (is_null( $id )) {
            return $this->handleInvalidRequest(
                Knight::API_ADD_MESSAGE_ERROR
                , Knight::API_INVALID_PAYLOAD_DATA
                , null
                , Knight::API_STATUS_400
            );
        }

        try {
            $knight = $this->knightHandler->get($id);

            /*knight found response*/
            return $this->json([
                'message' => Knight::API_GET_SUCCESS,
                'error' => null,
                'data' => $knight,
                'code' => Knight::API_STATUS_200,
            ], Knight::API_STATUS_200);
        } catch (NotFoundHttpException $exception) {
            /*knight not found response*/
            return $this->json([
                //todo: build the error message
                'message' => 'Knight #' . $id . ' not found.',
                'error' => $exception->getMessage(),
                'data' => null,
                'code' => Knight::API_STATUS_404,
            ], Knight::API_STATUS_404);
        }

    }

    /**
     * @Route("/knights"
     * , name="getKnights"
     * , methods={"GET"})
     */
    public function fetchAll(Request $request) :JsonResponse
    {
        $this->logger->info($request);

        $allKnights = $this->knightHandler->all();

        return $this->json([
            'message' => Knight::API_GET_SUCCESS,
            'error' => null,
            'data' => $allKnights,
            'code' => Knight::API_STATUS_200,
        ], Knight::API_STATUS_200);
    }
}
