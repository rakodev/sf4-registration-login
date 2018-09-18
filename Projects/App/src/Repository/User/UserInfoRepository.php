<?php

namespace App\Repository\User;


use App\Entity\User\UserInfo;
//use App\Repository\Base\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserInfoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserInfo::class);
    }

    public function addOrUpdateLanguage($userId, $language)
    {
        if (empty($entity)) {
            /** @var UserInfo $entity */
            $entity = $this->findOneBy(['userId' => $userId]);
        }
        if(empty($entity)) {
            $entity = new UserInfo();
            $entity->setUserId($userId);
        }
        $entity->setUserLanguage($language);

        $this->em->persist($entity);
        $this->em->flush();

        $this->getUserInfo($userId, true);
    }

    public function getUserInfo($userId, $clearCache = false)
    {
        $parameters = ['userId' => $userId];
        $query = "  SELECT *
                    from ".$this->getTableName()."
                    where user_id = :userId
                    limit 1";
        $result = $this->getCacheContent($query, $parameters, $clearCache);
        if(empty($result)) {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($parameters); // give parameter in SQL query like this :price
            $result = $stmt->fetch();
            $this->setCacheContent($query, $parameters, $result, $this->cacheService->getTimeoutLong());
        }

        return $result;
    }

}