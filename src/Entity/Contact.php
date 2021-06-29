<?php


namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Produit;
class Contact
{
   /*
    * @var string|null
    * @Assert\NotBlank()
    * @Assert\length(min=2,max =100)
    */
    private $firstName;
    /*
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\length(min=2,max =100)
     */
    private $lastName;
    /*
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern     = "/^[0-9](10)")
     *
     */
    private $phone;
    /*
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
    */
     private $email;
    /*
      * @var string|null
      * @Assert\NotBlank()
      * @Assert\length(min=10)
      */
       private $message;
        /*
         * @var Produit|null
         *
         */
       private $prod;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return Produit|null
     */
    public function getProd():Produit
    {
        return $this->prod;
    }

    /**
     * @param Produit|null $prod
     */
    public function setProd($prod): Contact
    {
        $this->prod = $prod;
        return $this;
    }


}

