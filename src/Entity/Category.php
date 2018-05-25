<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;
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
     * @SWG\Property(description="The unique identifier of the category.")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @SWG\Property(type="string", maxLength=45)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @SWG\Property(type="string", maxLength=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ConsultCategory", mappedBy="category", fetch="EXTRA_LAZY")
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
     * @return Collection|ConsultCategory[]
     */
    public function getCategoryUsers(): Collection
    {
        return $this->categoryUsers;
    }

    public function addCategoryUser(ConsultCategory $categoryUser): self
    {
        if (!$this->categoryUsers->contains($categoryUser)) {
            $this->categoryUsers[] = $categoryUser;
            $categoryUser->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryUser(ConsultCategory $categoryUser): self
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
