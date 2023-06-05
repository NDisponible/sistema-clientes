<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\ClientesRepository;
use Doctrine\ORM\Mapping as ORM;
/*use @Doctrine\ORM\Mapping\GenerateValue;*/
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email;


#[ORM\Entity(repositoryClass: ClientesRepository::class)]
/**
 *  Clientes
 * 
 * @ORM\Table(name="clientes")
 * @ORM\Entity
 */
class Clientes 
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string
     * @ORM\Column(name="cliente", type="string", length="100", nullable="false")
     * @Assert\NotBlank
     * Assert\Regex("/[a-zA-Z]+/")
     */
    #[ORM\Column(length: 100)]
    private ?string $cliente = null;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length="150", nullable="false")
     * @Assert\NotBlank
     * Assert\Email(
     *      message = "El email '{{ value }}' no es valido")
     */
    #[ORM\Column(length: 150)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?string
    {
        return $this->cliente;
    }

    public function setCliente(string $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
public function getUsername() {
    return $this->email;
}
public function getSalt() {
    return null;
}
public function eraseCredentials() {}
}