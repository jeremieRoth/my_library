<?php
/**
 * Created by PhpStorm.
 * User: jroth
 * Date: 10/21/19
 * Time: 4:31 PM
 */

namespace App\Controller;

use App\Entity\UserBookCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//use Symfony\Component\HttpFoundation\Response;

class AppController extends AbstractController
{
    /**
     * @Route("/home")
     */
    public function home()
    {

        return $this->render("layout.html.twig");
    }

    /**
     * @Route("/collection")
     */
    public function collection()
    {
        $em = $this->getDoctrine()->getManager();

        $bookList = $em->getRepository(UserBookCollection::class)->findOneByUser($this->getUser()->getId())
            ->getBookList()->getValues();

        return $this->render("app/collection.html.twig", array(
            'book_list' => $bookList
        ));
    }
}