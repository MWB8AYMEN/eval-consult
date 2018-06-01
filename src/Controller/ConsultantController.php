<?php

namespace App\Controller;

use App\Entity\Consultant;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ConsultantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @REST\RouteResource("consultant")

 */
class ConsultantController extends FOSRestController
{
    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function cgetAction(Request $request)
    {

        $em = $this->getDoctrine();
        $view = $this->view();

        $consultRepositoty = $em->getRepository(Consultant::class);
        $consultants = $consultRepositoty->findAll();

        $view->setTemplate('consultant/index.html.twig');
        $view->setTemplateData(array('consultants' => $consultants));

        return $view;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function newAction(Request $request)
    {
        $consultant = new Consultant();
        $form = $this->createForm(ConsultantType::class, $consultant);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultant);
            $em->flush();
            return $this->redirectToRoute('get_consultants');
        }



        return $this->render('consultant/form.html.twig',
            array('form'=>$form->createView()));
    }

    /**
     * @ParamConverter("consultant", options={"mapping": {"consultant"   : "id"}})
     * @REST\Route(path="/consultants/{consultant}/edit", methods={"GET","POST"})
     * @param Request $request
     * @return mixed
     */
    public function editAction(Request $request, Consultant $consultant)
    {

        $form = $this->createForm(ConsultantType::class, $consultant);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('get_consultants');
        }

        return $this->render('consultant/form.html.twig',
            array('form'=>$form->createView()));
    }
}
