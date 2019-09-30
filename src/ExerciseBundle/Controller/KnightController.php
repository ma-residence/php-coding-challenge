<?php

namespace ExerciseBundle\Controller;

use ExerciseBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as FosRest;
use ExerciseBundle\Entity\Knight;
use ExerciseBundle\Form\KnightType;
use ExerciseBundle\Handler\HandlerInterface;
use ExerciseBundle\Exception\ExceptionCodeInterface;
use Symfony\Component\HttpKernel\Exception\HttpException as HttpException;

class KnightController extends BaseController implements HandlerInterface
{  
    
    /**
     * @FosRest\View()
     *
     * @return \ExerciseBundle\Entity\Knight
     */
    public function postKnightAction()
    {
        try {
            /** @var ExerciseBundle:Knight $knight */
            $knight = new Knight();
            $form = $this->createForm(new KnightType(), $knight);          
            $form->submit($this->get('request')->request->all(), false);
            
            if ($this->get('request')->isMethod('POST') && $form->isValid()) {
                    $knight = $form->getData();
                    $this->getEntityManager()->persist($knight);
                    $this->getEntityManager()->flush();

                    return $this->view($knight, ExceptionCodeInterface::KNIGHT_201_CREATED);
            }
            
            return $this->view(
                $this->getErrorsForm($form), 
                ExceptionCodeInterface::KNIGHT_400_PARAMETERS
            );
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }
    } 
    
    /**
     * @FosRest\View()
     *
     * @param int $id
     * @return \ExerciseBundle\Entity\Knight
     */
    public function getKnightAction(int $id)
    {
        try {
            /** @var ExerciseBundle:Knight $knight */
            $knight = $this->getEntityManager()->getRepository('ExerciseBundle:Knight')->find($id);
            if (empty($knight)) {
                throw new HttpException(
                    ExceptionCodeInterface::KNIGHT_404_NOT_FOUND,
                    'Knight not found',
                    null,
                    [],
                    ExceptionCodeInterface::KNIGHT_404_NOT_FOUND
                );
            }
            
            return $this->view($knight, ExceptionCodeInterface::KNIGHT_200_SUCCESS);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }   
    } 
    
    /**
     * @FosRest\View()
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getKnightsAction(int $limit, int $offset)
    {
        try {
            /** @var ExerciseBundle:Knight[] $knights */
            $knights = $this->getEntityManager()->getRepository('ExerciseBundle:Knight')->findBy(array(), null, $limit, $offset);
           
            return $this->view($knights, ExceptionCodeInterface::KNIGHT_200_SUCCESS);
        } catch (\Exception $ex) {
            return $this->handleException($ex);
        }        
    } 
}
