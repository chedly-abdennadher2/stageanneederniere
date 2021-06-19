<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    * @Assert\NotBlank
     * @assert\Regex (
     *     pattern     = "/^[A-Za-z]+$/i",
     *
     * )
     * @assert\Length(min=5,max=30)
     */

    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */

    private $date_naiss;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixtotal;
 public  function __construct()
          {
         
          }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->date_naiss;
    }

    public function setDateNaiss(\DateTimeInterface $date_naiss): self
    {
        $this->date_naiss = $date_naiss;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPrixtotal(): ?float
    {
        return $this->prixtotal;
    }

    public function setPrixtotal(?float $prixtotal): self
    {
        $this->prixtotal = $prixtotal;

        return $this;
    }
}
