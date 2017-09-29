<?php
// src/AppBundle/Controller/index.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class index extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {

		//$logger->info('We are logging!');//su kien
        
         $number = mt_rand(0, 100);
			return $this->render('lucky/number.html.twig', 
                //array('number' => $number)
           [ 'number' => $number
        ]);
        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );
    }
}
