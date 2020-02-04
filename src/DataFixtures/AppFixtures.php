<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
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
            ->setRoles([])->setStatus(true);
        $manager->persist($user);

        $userBookCollection = new UserBookCollection();
        $userBookCollection->setName("default")->setUser($user);
        $manager->persist($userBookCollection);

        $disableUser = new User();
        $disableUser->setEmail("disablejr@gmail.com")->setName("disuser1")
            ->setPassword($this->encoder->encodePassword($disableUser, 'disuser1'))
            ->setRoles([])->setStatus(false);
        $manager->persist($disableUser);

        $disableUserBookCollection = new UserBookCollection();
        $disableUserBookCollection->setName("default")->setUser($user);
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
    }
}
