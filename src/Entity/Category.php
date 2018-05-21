<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCategory", mappedBy="category", fetch="EXTRA_LAZY")
     */
    private $categoryUsers;

    public function __construct()
    {
        $this->categoryUsers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|UserCategory[]
     */
    public function getCategoryUsers(): Collection
    {
        return $this->categoryUsers;
    }

    public function addCategoryUser(UserCategory $categoryUser): self
    {
        if (!$this->categoryUsers->contains($categoryUser)) {
            $this->categoryUsers[] = $categoryUser;
            $categoryUser->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryUser(UserCategory $categoryUser): self
    {
        if ($this->categoryUsers->contains($categoryUser)) {
            $this->categoryUsers->removeElement($categoryUser);
            // set the owning side to null (unless already changed)
            if ($categoryUser->getCategory() === $this) {
                $categoryUser->setCategory(null);
            }
        }

        return $this;
    }
}
