<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopicRepository::class)
 */
class Topic
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTopic;

    /**
     * @ORM\Column(type="boolean")
     */
    private $closed;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="topics")
     */
    private $userTopic;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="topics")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="topic")
     */
    private $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
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

    public function getDateTopic(): ?\DateTimeInterface
    {
        return $this->dateTopic;
    }

    public function setDateTopic(\DateTimeInterface $dateTopic): self
    {
        $this->dateTopic = $dateTopic;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getUserTopic(): ?User
    {
        return $this->userTopic;
    }

    public function setUserTopic(?User $userTopic): self
    {
        $this->userTopic = $userTopic;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function GetNbMessages()
    {
        return count($this->messages);
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setTopic($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getTopic() === $this) {
                $message->setTopic(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->title;
    }
}
