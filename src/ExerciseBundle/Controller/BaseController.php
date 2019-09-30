<?php

namespace ExerciseBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FosRest;
use Symfony\Component\HttpKernel\Exception\HttpException as HttpException;
use ExerciseBundle\Exception\ExceptionCodeInterface;

class BaseController extends FOSRestController
{  
    
    /**
     * 
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        /** @var Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        
        return $em;
    }
    
    /**
     * 
     * @param \Symfony\Component\Form\Form $form
     * @return array
     */
    protected function getErrorsForm(\Symfony\Component\Form\Form $form)
    {
        $response =  array();

        foreach ($form as $child) {
             foreach ($child->getErrors(true) as $error) {
                $response[$child->getName()][] = $error->getMessage();
             }
        }

        return $response;
    }
    
    /**
     * @param \Exception $exception
     * 
     * @return HttpException
     */
    protected function handleException() 
    {
        throw new HttpException(
            $exception->getCode(),
            $exception->getMessage(),
            null,
            [],
            $exception->getCode()
        );
    }
}
