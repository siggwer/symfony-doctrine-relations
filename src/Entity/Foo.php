<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FooRepository")
 */
class Foo
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Collection|Bar[]
     * @ORM\OneToMany(targetEntity="App\Entity\Bar", mappedBy="foo", cascade={"persist"}, orphanRemoval=true)
     */
    private $bars;

    /**
     * @var Collection|Tag[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag")
     */
    private $tags;

    /**
     * Foo constructor.
     */
    public function __construct()
    {
        $this->bars = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Foo
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Bar[]
     */
    public function getBars(): Collection
    {
        return $this->bars;
    }

    /**
     * @param Bar $bar
     * @return Foo
     */
    public function addBar(Bar $bar): self
    {
        if (!$this->bars->contains($bar)) {
            $this->bars[] = $bar;
            $bar->setFoo($this);
        }

        return $this;
    }

    /**
     * @param Bar $bar
     * @return Foo
     */
    public function removeBar(Bar $bar): self
    {
        if ($this->bars->contains($bar)) {
            $this->bars->removeElement($bar);
            if ($bar->getFoo() === $this) {
                $bar->setFoo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * Seulement utile pour le chargement des fixtures
     * @param Tag[]|Collection $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }
}
