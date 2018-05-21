<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as REST;

/**
 * @REST\RouteResource("category")
 * @REST\NamePrefix("api_")
 * @REST\Prefix("api")\
 */
class CategoryController extends Controller
{

    public function cgetAction()
    {
        return new Response(
            'new Response'
        );
    }
}
