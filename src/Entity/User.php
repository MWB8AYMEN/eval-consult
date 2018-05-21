<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->userCategories = new ArrayCollection();
        // your own logic
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCategory", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $userCategories;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UserCategory[]
     */
    public function getUserCategories(): Collection
    {
        return $this->userCategories;
    }

    public function addUserCategory(UserCategory $userCategory): self
    {
        if (!$this->userCategories->contains($userCategory)) {
            $this->userCategories[] = $userCategory;
            $userCategory->setUser($this);
        }

        return $this;
    }

    public function removeUserCategory(UserCategory $userCategory): self
    {
        if ($this->userCategories->contains($userCategory)) {
            $this->userCategories->removeElement($userCategory);
            // set the owning side to null (unless already changed)
            if ($userCategory->getUser() === $this) {
                $userCategory->setUser(null);
            }
        }

        return $this;
    }
}