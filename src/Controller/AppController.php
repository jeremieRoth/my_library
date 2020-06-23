<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\Series;
use App\Entity\UserBookCollection;
use App\Form\UserBookSeriesType;
use App\Form\UserBookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    public function collection(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bookCategory = $em->getRepository(BookCategory::class)->findOneByName('book');// TODO
        $bookAndSeries = new Book();
        $seriesForm = $this->createForm(UserBookSeriesType::class, $bookAndSeries);
        $seriesForm->handleRequest($request);

        if ($seriesForm->isSubmitted() && $seriesForm->isValid()){

            $date = new \DateTime();
            $bookAndSeries->setUpdateDate($date)->setCreationDate($date)->setStatus(true)
                ->setValidate(false)->setReleaseStatus(true);
            $bookAndSeries->getSeries()->setUpdateDate($date)->setCreationDate($date)->setStatus(true)->setValidate(false)
                ->setFinished(false)->setBookCategory($bookCategory);

            $this->getUser()->getUserBookCollection()->addBook($bookAndSeries);
            $em->persist($this->getUser()->getUserBookCollection());
            $em->flush();
        }

        $book = new Book();
        $bookForm = $this->createForm(UserBookType::class, $book);
        $bookForm->handleRequest($request);
        if ($bookForm->isSubmitted() && $bookForm->isValid()){
            $date = date("Y-m-d H:i:s");
            // TODO
            $em->flush();
        }
        $bookSerieList = $em->getRepository(UserBookCollection::class)->findSeriesAndBookByUser($this->getUser());


        return $this->render("app/collection.html.twig", array(
            'book_list' => $bookSerieList['books'],
            'serie_list' => $bookSerieList['series'],
            'serie_form' => $seriesForm->createView(),
            'book_form' => $bookForm->createView()
        ));
    }
}