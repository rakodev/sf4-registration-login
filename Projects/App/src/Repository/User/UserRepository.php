<?php

namespace App\Repository\User;

use App\Entity\User\User;
//use App\Repository\Base\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function loadUserByUsername($email, $setSession = true)
    {
        return  $this->findOneByUsername($email);
    }

    public function loadUserById($userId)
    {
        return $this->findOneById($userId);
    }

    public function updatePassword($userId, $password)
    {
        $user = $this->findOneById($userId);
        $user->setPassword($password);
        $this->_em->persist($user);
        $this->_em->flush();
        $cacheKey = $this->getCacheKey('user_' .$userId);
        $this->cache->delete($cacheKey);
        return $user;
    }

    public function isUsernameValid($email)
    {
        $user = $this->findOneBy(['username' => $email]);
        if(empty($user)) {
            return false;
        }
        return true;
    }

}