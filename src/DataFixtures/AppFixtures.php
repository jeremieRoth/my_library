<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\Series;
use App\Entity\User;
use App\Entity\UserBookCollection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @todo: refactor this to put code inside datafixture by entity
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // create admin user account
        $admin = new User();
        $admin->setEmail("rothjeremie@yahoo.fr")->setName("admin1")
            ->setPassword($this->encoder->encodePassword($admin, 'admin'))
            ->setRoles([$admin->getRoleList()['admin']])->setStatus(true);
        $manager->persist($admin);

        $adminBookCollection = new UserBookCollection();
        $adminBookCollection->setName("default")->setUser($admin);
        $manager->persist($adminBookCollection);

        // create user account
        $user = new User();
        $user->setEmail("jeremieroth@gmail.com")->setName("user1")
            ->setPassword($this->encoder->encodePassword($user, 'user1'))
            ->setRoles([$admin->getRoleList()['bd'],$admin->getRoleList()['book']])->setStatus(true);
        $manager->persist($user);

        $userBookCollection = new UserBookCollection();
        $userBookCollection->setName("default")->setUser($user);
        $manager->persist($userBookCollection);

        // create disable user account
        $disableUser = new User();
        $disableUser->setEmail("disablejr@gmail.com")->setName("disuser1")
            ->setPassword($this->encoder->encodePassword($disableUser, 'disuser1'))
            ->setRoles([])->setStatus(false);
        $manager->persist($disableUser);

        $disableUserBookCollection = new UserBookCollection();
        $disableUserBookCollection->setName("default")->setUser($disableUser);
        $manager->persist($disableUserBookCollection);

        // create book categories
        $mangaCategory = new BookCategory('manga');
        $comicBookCategory = new BookCategory('comic_book');
        $bdCategory = new BookCategory('bd');
        $bookCategory = new BookCategory('book');

        $manager->persist($mangaCategory);
        $manager->persist($comicBookCategory);
        $manager->persist($bdCategory);
        $manager->persist($bookCategory);

        $manager->flush();

        $serie1 = new Series();
        $serie2 = new Series();
        $serie3 = new Series();
        $serie1->setTitle('title1')->setStatus(true)->setBookCategory($bookCategory)->setValidate(true)->setCreationDate(new \DateTime())->setFinished(false)->setUpdateDate(new \DateTime());
        $serie2->setTitle('title2')->setStatus(true)->setBookCategory($bookCategory)->setValidate(true)->setCreationDate(new \DateTime())->setFinished(true)->setUpdateDate(new \DateTime());
        $serie3->setTitle('title3')->setStatus(false)->setBookCategory($bookCategory)->setValidate(false)->setCreationDate(new \DateTime())->setFinished(false)->setUpdateDate(new \DateTime());

        $manager->persist($serie1);
        $manager->persist($serie2);
        $manager->persist($serie3);
        $book1 = new Book();
        $book2 = new Book();
        $book3 = new Book();
        $book4 = new Book();
        $book1->setStatus(true)->setTitle("book1")->setAuthor('azerty')->setIsbn('123')->setReleaseDate(new \DateTime())->setReleaseStatus(true)->setSpecial(false)->setSeries($serie1);
        $book2->setStatus(true)->setTitle("book2")->setAuthor('azerty')->setIsbn('123')->setReleaseDate(new \DateTime())->setReleaseStatus(true)->setSpecial(false)->setSeries($serie1);
        $book3->setStatus(true)->setTitle("book3")->setAuthor('azerty')->setIsbn('123')->setReleaseDate(new \DateTime())->setReleaseStatus(false)->setSpecial(true)->setSeries($serie2);
        $book4->setStatus(false)->setTitle("book4")->setAuthor('azerty')->setIsbn('123')->setReleaseDate(new \DateTime())->setReleaseStatus(true)->setSpecial(false)->setSeries($serie3);
        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);
        $manager->persist($book4);
        $manager->flush();

        $userBookCollection->addBook($book1);
        $manager->persist($userBookCollection);
        $manager->flush();
    }
}
