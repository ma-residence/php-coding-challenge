<?php

namespace App\Controller;

use App\Entity\Knight;
use App\Handler\KnightHandler;
use App\Services\Arena;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class KnightController
 */
class KnightController extends AbstractController
{
    /**
     * get a knight
     * @Route("/knight/{knightId}", methods={"GET"})
     * @return JsonResponse
     */
    public function getKnight(
        $knightId,
        SerializerInterface $serializer,
        KnightHandler $handler
    ) {
        $knight = $handler->get($knightId);

        if(!$knight) {
            $response = ['message' => "Knight #$knightId not found.", 'code' => Response::HTTP_NOT_FOUND];
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }
        $data = $serializer->toArray($knight);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * get the list of knights
     * @Route("/knights", methods={"GET"})
     * @return JsonResponse
     */
    public function getKnights(
        SerializerInterface $serializer,
        Request $request,
        KnightHandler $handler
    ) {
        $limit = $request->query->get('limit', 100);
        $offset = $request->query->get('offset', 0);

        $knights = $handler->all($limit, $offset);
        $data = $serializer->toArray($knights);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * create a knight
     * @Route("/knight", methods={"POST"})
     * @return JsonResponse
     */
    public function postKnight(Request $request, KnightHandler $handler)
    {
        $data = json_decode($request->getContent(), true);
        $isFormValid = $handler->post($data);

        if ($isFormValid) {
            return new JsonResponse(['status' => 'OK'], Response::HTTP_CREATED);
        }
        $response = ['message' => 'form is not valid', 'code' => Response::HTTP_BAD_REQUEST];

        return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
    }

    /**
     * get the result of the fight
     * @Route("/fight/{knight1}/{knight2}", methods={"GET"})

     * @return JsonResponse
     */
    public function getFight(Knight $knight1, Knight $knight2, Arena $arenaService)
    {
        $result = $arenaService->fight($knight1, $knight2);

        return new JsonResponse(['result' => $result], Response::HTTP_OK);
    }
}

