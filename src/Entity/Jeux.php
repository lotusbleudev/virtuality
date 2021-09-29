<?php

namespace App\Entity;

use App\Repository\JeuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JeuxRepository::class)
 */
class Jeux
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
     * @ORM\Column(type="string", length=255)
     */
    private $editeur;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_cover;

    /**
     * @ORM\Column(type="array")
     */
    private $img_gameplay = [];

    /**
     * @ORM\OneToMany(targetEntity=Tournois::class, mappedBy="jeu")
     */
    private $tournois;

    /**
     * @ORM\Column(type="integer")
     */
    private $minJoueur;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxJoueur;

    public function __construct()
    {
        $this->tournois = new ArrayCollection();
    }

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

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getImgCover(): ?string
    {
        return $this->img_cover;
    }

    public function setImgCover(string $img_cover): self
    {
        $this->img_cover = $img_cover;

        return $this;
    }

    public function getImgGameplay(): ?array
    {
        return $this->img_gameplay;
    }

    public function setImgGameplay(array $img_gameplay): self
    {
        $this->img_gameplay = $img_gameplay;

        return $this;
    }

    /**
     * @return Collection|Tournois[]
     */
    public function getTournois(): Collection
    {
        return $this->tournois;
    }

    public function addTournoi(Tournois $tournoi): self
    {
        if (!$this->tournois->contains($tournoi)) {
            $this->tournois[] = $tournoi;
            $tournoi->setJeu($this);
        }

        return $this;
    }

    public function removeTournoi(Tournois $tournoi): self
    {
        if ($this->tournois->removeElement($tournoi)) {
            // set the owning side to null (unless already changed)
            if ($tournoi->getJeu() === $this) {
                $tournoi->setJeu(null);
            }
        }

        return $this;
    }

    public function getMinJoueur(): ?int
    {
        return $this->minJoueur;
    }

    public function setMinJoueur(int $minJoueur): self
    {
        $this->minJoueur = $minJoueur;

        return $this;
    }

    public function getMaxJoueur(): ?int
    {
        return $this->maxJoueur;
    }

    public function setMaxJoueur(int $maxJoueur): self
    {
        $this->maxJoueur = $maxJoueur;

        return $this;
    }
}
