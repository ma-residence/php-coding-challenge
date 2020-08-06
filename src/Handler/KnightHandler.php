<?php


namespace App\Handler;

use App\Entity\Knight;
use App\Form\KnightType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;


class KnightHandler implements HandlerInterface
{
    private $entityManager;
    private $formFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    /**
     * Get a resource
     *
     * @param int $id
     * @return Object
     */
    public function get($id)
    {
        $repository = $this->entityManager->getRepository(Knight::class);
        return $repository->find($id);
    }

    /**
     * Get a collection of resources
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function all($limit, $offset)
    {
        $repository = $this->entityManager->getRepository(Knight::class);
        return $repository->getKnights($limit, $offset);
    }

    /**
     * Register a resource
     *
     * @param $resource
     * @return mixed
     */
    public function post($resource)
    {
        $knight = new Knight();
        $form = $this->formFactory->create(KnightType::class, $knight);
        $form->submit($resource);

        if ($form->isValid()) {
            $this->entityManager->persist($knight);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

}

