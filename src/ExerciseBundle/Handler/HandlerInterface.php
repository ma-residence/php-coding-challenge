<?php

namespace ExerciseBundle\Handler;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface HandlerInterface
 *
 * Must be implemented in the handlers.
 *
 * @package ExerciseBundle\Handler
 */
interface HandlerInterface
{
    /**
     * Get a resource
     *
     * @param int $id
     * @return Object
     */
    public function getKnightAction(int $id);

    /**
     * Get a collection of resources
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getKnightsAction(int $limit, int $offset);

    /**
     * Register a resource
     *
     * @return mixed
     */
    public function postKnightAction();
}
