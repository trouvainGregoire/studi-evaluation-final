<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\MissionRepository;
use App\Validator\MissionAgent;
use App\Validator\MissionContact;
use App\Validator\MissionHideway;
use App\Validator\MissionTarget;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 * @UniqueEntity("codeName")
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="mission:list"}}},
 *     itemOperations={"get"={}},
 *     order={"startAt"="ASC"},
 *     paginationEnabled=true
 * )
 */
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"mission:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"mission:list"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"mission:list"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */

    private $codeName;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("datetime")
     * @Groups({"mission:list"})
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("datetime")
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity=Agent::class, inversedBy="missions")
     * @Assert\NotNull()
     * @MissionAgent()
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="missions")
     * @Assert\NotNull()
     * @MissionContact()
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Target::class, mappedBy="mission", cascade={"remove"})
     * @Assert\NotNull()
     * @MissionTarget()
     */
    private $targets;

    /**
     * @ORM\ManyToOne(targetEntity=MissionType::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=MissionStatus::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     * @Groups({"mission:list"})
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Hideway::class, inversedBy="missions")
     * @MissionHideway()
     */
    private $hideways;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $speciality;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->hideways = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

        return $this;
    }

    public function getStartAt(): ?DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): self
    {

        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
            $target->setMission($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        if ($this->targets->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getMission() === $this) {
                $target->setMission(null);
            }
        }

        return $this;
    }

    public function getType(): ?MissionType
    {
        return $this->type;
    }

    public function setType(?MissionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?MissionStatus
    {
        return $this->status;
    }

    public function setStatus(?MissionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Hideway[]
     */
    public function getHideways(): Collection
    {
        return $this->hideways;
    }

    public function addHideway(Hideway $hideway): self
    {
        if (!$this->hideways->contains($hideway)) {
            $this->hideways[] = $hideway;
        }

        return $this;
    }

    public function removeHideway(Hideway $hideway): self
    {
        $this->hideways->removeElement($hideway);

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }
}
