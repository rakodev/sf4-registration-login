<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegistrationModel
 * @package App\Model
 */
class RegistrationModel
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    protected $userName;

    /**
     * @Assert\NotBlank(message="You need to specify a password.")
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     */
    protected $plainPassword;

    /**
     * @Assert\NotBlank(message="You need to specify your billing address.")
     * @Assert\Length(
     *      min = 25,
     *      max = 200,
     *      minMessage = "Your billing address must be at least {{ limit }} characters long",
     *      maxMessage = "Your billing address cannot be longer than {{ limit }} characters"
     * )
     */
    protected $billingAddress;

    /**
     * @Assert\NotBlank(message="You need to specify your name.")
     * @Assert\Length(
     *      min = 2,
     *      max = 80,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $name;

    /**
     * @Assert\NotBlank(message="You need to specify your company identification.")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your company identification must be at least {{ limit }} characters long",
     *      maxMessage = "Your company identification cannot be longer than {{ limit }} characters"
     * )
     */
    protected $companyIdentification;

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress($billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCompanyIdentification()
    {
        return $this->companyIdentification;
    }

    /**
     * @param mixed $companyIdentification
     */
    public function setCompanyIdentification($companyIdentification): void
    {
        $this->companyIdentification = $companyIdentification;
    }
}