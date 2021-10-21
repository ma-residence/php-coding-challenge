<?php

namespace App\Controller;

use App\Entity\Knight;
use App\Repository\KnightRepository;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class KnightController extends AbstractController
{
    private KnightRepository $knightRepository;
    private LoggerInterface $logger;

    /**
     * @param KnightRepository $knightRepository
     * @param LoggerInterface $logger
     */
    public function __construct(KnightRepository $knightRepository
        , LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->knightRepository = $knightRepository;
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
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Request $request): JsonResponse
    {
        $this->logger->info($request);

        /*json only allowed*/
        if (!$this->isValidRequest($request)) {
            return $this->handleInvalidRequest();
        }

        $data = json_decode($request->getContent());

        if (empty($data->name) || empty($data->strength) || empty($data->weaponPower)) {
            return $this->handleInvalidRequest(
                  'form is not valid'
                , Knight::API_INVALID_PAYLOAD_DATA
                , $data
                , Knight::API_STATUS_400
            );
        }

        $em = $this->getDoctrine()->getManager();
        $knight = new Knight($data->name, $data->strength, $data->weaponPower);

        try {
            $em->persist($knight);
            $em->flush();

            return $this->json([
                'message' => Knight::API_ADD_MESSAGE_SUCCESS,
                'error' => null,
                'data' => $knight,
                'code' => Knight::API_STATUS_201,
            ], Knight::API_STATUS_201);
        } catch (ORMException $exception) {
            $this->logger->error(Knight::API_ADD_MESSAGE_ERROR);
            $this->logger->error($exception->getCode());
            $this->logger->error($exception->getMessage());

            return $this->json([
                'message' => Knight::API_ADD_MESSAGE_ERROR,
                'error' => $exception->getMessage(),
                'data' => null,
                'code' => Knight::API_STATUS_400,
            ], Knight::API_STATUS_400);
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

        $knight = $this->knightRepository->findOneBy(['id' => $id]);
        if ($knight) {
            return $this->json([
                'message' => Knight::API_GET_SUCCESS,
                'error' => null,
                'data' => $knight,
                'code' => Knight::API_STATUS_200,
            ], Knight::API_STATUS_200);
        }

        /*not found response*/
        return $this->json([
            'message' => 'Knight #' . $id . ' not found.',
            'error' => Knight::API_GET_ERROR_NOT_FOUND,
            'data' => null,
            'code' => Knight::API_STATUS_404,
        ], Knight::API_STATUS_404);;
    }

    /**
     * @Route("/knights"
     * , name="getKnights"
     * , methods={"GET"})
     */
    public function fetchAll(Request $request) :JsonResponse
    {
        $this->logger->info($request);

        $allKnights = $this->knightRepository->findAll();

        return $this->json([
            'message' => Knight::API_GET_SUCCESS,
            'error' => null,
            'data' => $allKnights,
            'code' => Knight::API_STATUS_200,
        ], Knight::API_STATUS_200);
    }
}
