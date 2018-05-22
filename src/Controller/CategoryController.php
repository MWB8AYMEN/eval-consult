<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Category;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;

/**
 *
 *
 * @REST\RouteResource("category")
 * @REST\NamePrefix("api_")
 */
class CategoryController extends Controller
{
    /*
     *
     * List categories.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/categories", name="api_get_categories", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns all categories",
     * )
     *
     */
    /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/categories", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Category::class, groups={"full"}))
     *     )
     * )
     * 
     * @SWG\Tag(name="rewards")
     * @Security(name="Bearer")
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine();



        $catRepositoty = $em->getRepository(Category::class)->findAll();

        if ($catRepositoty){
            $categories = array();
            foreach ($catRepositoty as $cat){
                $category['id'] = $cat->getId();
                $category['name'] = $cat->getName();
                $category['description'] = $cat->getDescription();
                $response['result'][] = $category;
            }

            $jsonResponse = new JsonResponse(array($response,'code'=>200));

        }else{
            $jsonResponse = new JsonResponse( array('err'=> 'no categories exists'), array('code' => 404));
        }


        return $jsonResponse;
    }

    public function noteAction()
    {
        return array('action' => 'new');
    }

    public function editAction()
    {
        return array('action' => 'edit');
    }
}
