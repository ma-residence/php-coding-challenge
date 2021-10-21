<?php

namespace App\Handler;

use App\Entity\Knight;
use App\Repository\KnightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class KnightHandler implements HandlerInterface
{
    private knightRepository $knightRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(knightRepository $knightRepository, EntityManagerInterface $entityManager)
    {
        $this->knightRepository = $knightRepository;
        $this->entityManager = $entityManager;
    }
    public function get(int $id) :Knight
    {
        $knight = $this->knightRepository->findOneBy(['id' => $id]);
         if (is_null($knight)) {
             throw new NotFoundHttpException('form is not valid');
         }

         return $knight;
    }

    public function all($limit=0, $offset=0) :array
    {
        //todo: implement pagination
        return $this->knightRepository->findAll();
    }

    public function post($resource)
    {
        /**
         * @var addKnightDataObject $data
         */
        if (
            !$resource instanceof addKnightDataObject //can't prototype because of InterfaceSignature
            || empty($resource->getName()) || empty($resource->getStrength()) || empty($resource->getWeaponPower()))
        {
            throw new \HttpInvalidParamException(Knight::API_GET_ERROR_NOT_FOUND);
        }

        try {
            $knight = new Knight($resource->getName(), $resource->getStrength(), $resource->getWeaponPower());

            $this->entityManager->persist($knight);
            $this->entityManager->flush();

            return $knight;
        } catch (\Throwable $exception) {
            //todo: better handling of exception
            throw $exception;
        }
    }
}
