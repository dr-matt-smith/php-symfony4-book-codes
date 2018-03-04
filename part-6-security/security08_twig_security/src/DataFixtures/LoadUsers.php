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
        $userUser = $this->createUser('user', 'user');
        $userAdmin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $userMatt = $this->createUser('matt',  'smith', ['ROLE_SUPER_ADMIN']);

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
    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);

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
