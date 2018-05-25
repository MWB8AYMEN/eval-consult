<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;
/**
 * @ORM\Table(name="consultant")
 * @ORM\Entity(repositoryClass="App\Repository\ConsultantRepository")
 */
class Consultant
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
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $plateform;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $fonction;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbExperiences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConsultCategory", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $consultCategories;

    public function __construct()
    {
        $this->consultCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPlateform(): ?string
    {
        return $this->plateform;
    }

    public function setPlateform(?string $plateform): self
    {
        $this->plateform = $plateform;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(?string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getNbExperiences(): ?int
    {
        return $this->nbExperiences;
    }

    public function setNbExperiences(int $nbExperiences): self
    {
        $this->nbExperiences = $nbExperiences;

        return $this;
    }

    /**
     * @return Collection|consultCategory[]
     */
    public function getConsultCategories(): Collection
    {
        return $this->consultCategories;
    }

    public function addConsultCategory(consultCategory $consultCategory): self
    {
        if (!$this->consultCategories->contains($consultCategory)) {
            $this->consultCategories[] = $consultCategory;
            $consultCategory->setUser($this);
        }

        return $this;
    }

    public function removeConsultCategory(consultCategory $consultCategory): self
    {
        if ($this->consultCategories->contains($consultCategory)) {
            $this->consultCategories->removeElement($consultCategory);
            // set the owning side to null (unless already changed)
            if ($consultCategory->getUser() === $this) {
                $consultCategory->setUser(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

}