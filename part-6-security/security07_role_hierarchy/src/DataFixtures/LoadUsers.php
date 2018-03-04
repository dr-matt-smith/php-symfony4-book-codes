<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class LoadUsers extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // create objects
        $userUser = $this->createActiveUser('user', 'user@yser.com', 'user');
        $userAdmin = $this->createActiveUser('admin', 'admin@admin.com', 'admin', ['ROLE_ADMIN']);
        $userMatt = $this->createActiveUser('matt', 'matt@matt.com', 'smith', ['ROLE_SUPER_ADMIN']);

        // store to DB
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userMatt);
        $manager->flush();
    }

    /**
     * @param       $username
     * @param       $email
     * @param       $plainPassword
     * @param array $roles // default to ROLE_USER if no ROLE supplied
     *
     * @return User
     */
    private function createActiveUser($username, $email, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setIsActive(true);

        // password - and encoding
        $encodedPassword = $this->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }

    private function encodePassword($user, $plainPassword):string
    {
        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        return $encodedPassword;
    }
}
