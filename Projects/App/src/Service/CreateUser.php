<?php


namespace App\Service;


use App\Entity\User\User;
use App\Entity\User\UserInfo;
use App\Model\RegistrationModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class CreateUser
 * @package App\Service
 */
class CreateUser
{
    private $entityManager;
    private $passwordEncoder;

    /**
     * CreateUser constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param RegistrationModel $registrationModel
     * @return mixed
     */
    public function persistUser(RegistrationModel $registrationModel)
    {
        $user = new User();
        $user->setUsername($registrationModel->getUserName());
        $user->setPlainPassword($registrationModel->getPlainPassword());
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $user->getPlainPassword())
        );

        $userInfo = new UserInfo();
        $userInfo->setUser($user);
        $userInfo->setName($registrationModel->getName());
        $userInfo->setBillingAddress($registrationModel->getBillingAddress());
        $userInfo->setCompanyIdentification($registrationModel->getCompanyIdentification());

        $this->entityManager->persist($user);
        $this->entityManager->persist($userInfo);
        $this->entityManager->flush();

        return $user;
    }
}