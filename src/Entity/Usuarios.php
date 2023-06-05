<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 100)]
    private ?string $poblacion = null;

    #[ORM\Column(length: 10)]
    private ?string $categoria = null;

    #[ORM\Column]
    private ?int $edad = null;

    #[ORM\Column(length: 20)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaModificacion = null;

    #[ORM\Column]
    private ?int $idCliente = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }
    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }
    public function getPoblacion(): ?string
    {
        return $this->poblacion;
    }
    public function setPoblacion(string $poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }
    public function getCategoria(): ?string
    {
        return $this->categoria;
    }
    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
    public function getEdad(): ?int
    {
        return $this->edad;
    }
    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }
    public function getEstado(): ?string
    {
        return $this->estado;
    }
    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }
    public function getFechaModificacion(): ?\DateTimeInterface
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion(?\DateTimeInterface $fechaModificacion): self
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }
    public function getIdCliente(): ?int
    {
        return $this->idCliente;
    }
    public function setIdCliente(int $idCliente): self
    {
        $this->idCliente = $idCliente;

        return $this;
    }
}