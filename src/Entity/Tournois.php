<?php

namespace App\Entity;

use App\Repository\TournoisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TournoisRepository::class)
 */
class Tournois
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_player;

    /**
     * @ORM\ManyToOne(targetEntity=Jeux::class, inversedBy="tournois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jeu;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $user = [];

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaxPlayer(): ?int
    {
        return $this->max_player;
    }

    public function setMaxPlayer(int $max_player): self
    {
        $this->max_player = $max_player;

        return $this;
    }

    public function getJeu(): ?Jeux
    {
        return $this->jeu;
    }

    public function setJeu(?Jeux $jeu): self
    {
        $this->jeu = $jeu;

        return $this;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function setUser(?array $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}