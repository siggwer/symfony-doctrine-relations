<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BarRepository")
 */
class Bar
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
     * @var Foo|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Foo", inversedBy="bars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $foo;

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
     * @return Bar
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Foo|null
     */
    public function getFoo(): ?Foo
    {
        return $this->foo;
    }

    /**
     * @param Foo|null $foo
     * @return Bar
     */
    public function setFoo(?Foo $foo): self
    {
        $this->foo = $foo;

        return $this;
    }
}
