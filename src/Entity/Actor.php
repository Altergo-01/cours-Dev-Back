<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['lastname' => 'partial', 'firstname' => 'partial', 'id' => 'exact'])]
#[ApiFilter(DateFilter::class, properties: ['dob' => 'partial' ])]
#[Get]
#[Put(security: "is_granted('ROLE_ADMIN')")]
#[GetCollection]
#[Post(security: "is_granted('ROLE_ADMIN')")]
#[Patch(security : "is_granted('ROLE_ADMIN')")]
#[Delete(security : "is_granted('ROLE_ADMIN')")]
#[ORM\HasLifecycleCallbacks]
class Actor
{


    #[ORM\Id]
    #[Assert\NotBlank]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'actor', cascade: ["persist"])]
    #[Assert\NotBlank]
    private Collection $movies;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reward = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/image'])]
    public ?MediaObject $mediaObject = null;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(?\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }
    #[ORM\PrePersist]
    public function setCreateAt(): static
    {
        if($this->createAt === null){
            $this->createAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
      return  $this->movies->removeElement($movie);
    }

    public function getReward(): ?string
    {
        return $this->reward;
    }

    public function setReward(?string $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return MediaObject|null
     */

    public function getMediaObject(): ?MediaObject
    {
        return $this->mediaObject;
    }

    public function setMediaObject(?MediaObject $mediaObject): Actor
    {
        $this->mediaObject = $mediaObject;

        return $this;
    }

    public function removeMediaObject(?MediaObject $mediaObject): static
    {
        $this->mediaObject = null;

        return $this;
    }



}