<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Entity\ConsultCategory;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Category;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Psr\Log\LoggerInterface;

/**
 *
 *
 * @REST\RouteResource("category")

 */
class CategoryController extends FOSRestController
{
    public function cgetAction(Request $request)

    {

        $em = $this->getDoctrine();
        $view = $this->view();


        $catRepositoty = $em->getRepository(Category::class);
        $categories = $catRepositoty->findAll();

        $mobile = $this->isMobile($request);

        $logger = $this->get('logger');

        $logger->info('request : '.$request->headers->get('User-Agent'));

        if($mobile){

            if ($categories){

                foreach ($categories as $cat){
                    $this->get('logger')->info('request : '.$cat->getId());
                    $category['id'] = $cat->getId();
                    $category['name'] = $cat->getName();
                    $category['description'] = $cat->getDescription();
                    $response['result'][] = $category;
                }
                $response['code'] = 200;
                $jsonResponse = new JsonResponse($response);

            }else{
                $jsonResponse = new JsonResponse( array('err'=> 'no categories exists'), array('code' => 404));
            }

            return $jsonResponse;

        } else {
            $view->setTemplate('category/index.html.twig');
            $view->setTemplateData(array('categories' => $categories));

            return $view;
        }
    }

    function isMobile($request)
    {
        if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|
                     iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|
                     philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|
                     up\.link|vodafone|wap|webos|wireless|xda|xoom|zte|okhttp)/i', $request->headers->get('user-agent')
        )
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @REST\Route(methods={"POST"})
     * @param Request $request
     * @return mixed
     */

    public function noteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $catNotes = $request->request->get('categories');

        $username = $request->request->get('username');


        $consultant = $em->getRepository(Consultant::class)->findOneBy(array('username'=>$username));


        foreach($catNotes as $cat){

            $category = $em->getRepository(Category::class)->findOneBy(array('id'=>$cat['category']));
            $consultantCategory = new ConsultCategory();
            $consultantCategory->setconsultant($consultant);
            $consultantCategory->setCategory($category);
            $consultantCategory->setNote($cat['note']);
            $consultantCategory->setComment($cat['comment']);
            $consultantCategory->setInsertedAt(new \DateTime("now"));
            $em->persist($consultantCategory);
        }
        $em->flush();
       return $catNotes;

    }

    /**
     * @REST\Route(methods={"GET","POST"})
     * @param Request $request
     * @return mixed
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        $em = $this->getDoctrine();

        $catRepositoty = $em->getRepository(Category::class)->findAll();

        if ($catRepositoty) {

            foreach ($catRepositoty as $cat) {
                $category['id'] = $cat->getId();
                $category['name'] = $cat->getName();
                $category['description'] = $cat->getDescription();
                $response['result'][] = $category;
            }
            $response['code'] = 200;
            $jsonResponse = new JsonResponse($response);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();
                return $this->redirectToRoute('get_categories');
            }
        }
        
        return $this->render('category/form.html.twig',
            array('form'=>$form->createView()));
    }

    /**
     * @ParamConverter("category", options={"mapping": {"category"   : "id"}})
     * @REST\Route(path="/categories/{category}/edit", methods={"GET","POST"})
     * @param Request $request
     * @return mixed
     */
    public function editAction(Request $request, Category $category)
    {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('get_categories');
        }

        return $this->render('category/form.html.twig',
            array('form'=>$form->createView()));
    }
}
