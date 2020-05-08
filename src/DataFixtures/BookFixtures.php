<?php

namespace App\DataFixtures;

use App\DataFixtures\AuthorFixtures;
use App\Entity\Book;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class BookFixtures extends Fixture
{
    public const AUTHOR_REFERENCE = 'book-';
    public const NB_BOOK = 100;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0 ; $i < self::NB_BOOK ; $i++) {
            $book = new Book();
            $book->setSummary($faker->name);
            $book->setTitle($faker->name);
            $book->setIsbn($faker->isbn13);
            $book->setReleaseStatus(true);
            $book->setStatus(true);
            $book->setSpecial(true);
            $authorRef = AuthorFixtures::AUTHOR_REFERENCE . rand(0,AuthorFixtures::NB_AUTHOR-1);
            $book->setAuthor($this->getReference($authorRef));
            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
             AuthorFixtures::class,
        );
    }
}
