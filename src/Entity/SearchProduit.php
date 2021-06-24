<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class SearchProduit
{
    /*
     * @var ArrayCollection
     */
    private  $options;
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }
    public function addOptions(string $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }
    public function getOptions(): Collection
    {
        return $this->options;
    }


}