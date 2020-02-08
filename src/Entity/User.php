<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nom ne peut être vide")
     * @Assert\Length(min=2, minMessage="Le nom est trop court",
     *      max=100, maxMessage="Le nom est trop long")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le prénom ne peut être vide")
     * @Assert\Length(min=2, minMessage="Le prénom est torp court",
     *     max=100, maxMessage="Le prénom est trop long")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message="La ville ne peut être vide")
     * @Assert\Length(min=2, minMessage="Le nom de ville est trop court",
     *     max=200, maxMessage="Le nom de ville est trop long")
     */
    private $city;

    /**
     * @ORM\Column(type="integer", length=5)
     * @Assert\NotBlank(message="Le code postal ne peut être vide")
     * @Assert\Type(type="integer", message="Le code postal doit contenir des chiffres")
     * @Assert\Length(min=5, minMessage="Le code postal est trop court",
     *     max=10, maxMessage="Le code postal est trop long")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'addresse e-mail ne peut être vide")
     * @Assert\Email(message="L'adresse e-mail doit être e-mail valide")
     * @Assert\Length(min=2, minMessage="L'adresse e-mail est trop court",
     *     max=255, maxMessage="L'adresse e-mail est trop long")
     */
    private $email;

    /**
     * @ORM\Column(type="bigint", length=10, nullable=true)
     * @Assert\Length(max=10, maxMessage="Le numéro de téléphone est trop long")
     * @Assert\Type(type="integer", message="Le numéro de téléphone doit contenir des chiffres")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le mot de passe ne peut être vide")
     * @Assert\Length(min=5, minMessage="Le mot de passe est trlp court",
     *     max=255, maxMessage="Le mot de passe est tro long")
     */
    private $password;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $role;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->role = ["ROLE_USER"];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }
}
