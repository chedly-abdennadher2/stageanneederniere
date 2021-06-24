<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $type;


    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Option::class, mappedBy="Opt")
     */
    private $options;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->options = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }



    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setOpt($this);
        }

        return $this;
    }

    public function removeOption(option $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getOpt() === $this) {
                $option->setOpt(null);
            }
        }

        return $this;
    }
}
