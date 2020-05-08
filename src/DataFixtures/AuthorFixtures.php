<?php

namespace App\DataFixtures;

use App\Entity\Author;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AuthorFixtures extends Fixture
{
    public const AUTHOR_REFERENCE = 'author-';
    public const NB_AUTHOR = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0 ; $i < self::NB_AUTHOR ; $i++) {
            $author = new Author();
            $author->setName($faker->name);
            $this->addReference(self::AUTHOR_REFERENCE.$i, $author);

            $manager->persist($author);
        }
        $manager->flush();
    }
}
