<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @Vich\Uploadable
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
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;


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
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;

    }
     public function setImageFile(?File $imagefile = null):void
{
    $this->imageFile=$imagefile;
    // VERY IMPORTANT:
    // It is required that at least one field changes if you are using Doctrine,
    // otherwise the event listeners won't be called and the file is lost
    if ($this->image) {
        dump($this->image);
        // if 'updatedAt' is not defined in your entity, use another property
        $this->updated_at = new DateTime('now');
    dump($this->updated_at);
    }

}


    public function getImage()
    {
        return $this->image;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

}
