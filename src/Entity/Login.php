<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Session
{
    private string $sessionId;

    private string $sessionData;

    private \DateTime $updatedAt;

    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    public function getSessionData(): string
    {
        return $this->sessionData;
    }

    public function setSessionData(string $sessionData): self
    {
        $this->sessionData = $sessionData;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
