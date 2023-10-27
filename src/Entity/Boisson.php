<?php

namespace App\Entity;

use App\Repository\BoissonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
class Boisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nb_calories = null;

    #[ORM\Column(length: 90)]
    private ?string $type_de_bouteille = null;

    #[ORM\ManyToOne(inversedBy: 'boissons')]
    private ?Marque $marque_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbCalories(): ?int
    {
        return $this->nb_calories;
    }

    public function setNbCalories(int $nb_calories): static
    {
        $this->nb_calories = $nb_calories;

        return $this;
    }

    public function getTypeDeBouteille(): ?string
    {
        return $this->type_de_bouteille;
    }

    public function setTypeDeBouteille(string $type_de_bouteille): static
    {
        $this->type_de_bouteille = $type_de_bouteille;

        return $this;
    }

    public function getMarqueId(): ?Marque
    {
        return $this->marque_id;
    }

    public function setMarqueId(?Marque $marque_id): static
    {
        $this->marque_id = $marque_id;

        return $this;
    }
}
