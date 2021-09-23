<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {


    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $name;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}