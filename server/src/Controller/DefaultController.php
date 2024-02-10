<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly BookRepository $bookRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    #[Route('/newBook')]
    public function addNewBook(): Response
    {
        $book = new Book();
        $book->setTitle('new book1');
        $this->em->persist($book);
        $this->em->flush();

        return new Response();
    }

    #[Route('/', name: 'root')]
    public function root(): Response
    {
        $books = $this->bookRepository->findAll();

        return $this->json($books);
    }
}
