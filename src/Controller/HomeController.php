<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $env = $this->container->get( 'kernel' )->getEnvironment();
        dump($_SERVER['DATABASE_URL']);

        return new Response(
            '<html><body> Bonjour, je suis '.$env.'</body></html>'
        );
    }
}