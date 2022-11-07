<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\Entity;

use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationEmail;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationName;
use Shared\Domain\ValueObjects\DateTimeValueObject;

final class EmailNotification
{
    private function __construct(
        private EmailNotificationId $id,
        private EmailNotificationName $name,
        private EmailNotificationEmail $email,
        private DateTimeValueObject $createdAt,
        private DateTimeValueObject $updatedAt
    ) {
    }

    public static function create(
        EmailNotificationId $id,
        EmailNotificationName $name,
        EmailNotificationEmail $email
    ): self
    {
        return new self(
            $id,
            $name,
            $email,
            new DateTimeValueObject(),
            new DateTimeValueObject()
        );
    }

    public static function fromPrimitives(
        string $id,
        string $name,
        string $email,
        string $createdAt,
        string $updatedAt
    ): self
    {
        return new self(
            new EmailNotificationId($id),
            new EmailNotificationName($name),
            new EmailNotificationEmail($email),
            new DateTimeValueObject($createdAt),
            new DateTimeValueObject($updatedAt)
        );
    }

    public function id(): EmailNotificationId
    {
        return $this->id;
    }

    public function name(): EmailNotificationName
    {
        return $this->name;
    }

    public function email(): EmailNotificationEmail
    {
        return $this->email;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }

    public function toArray()
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'email' => $this->email()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()->value(),
        ];
    }

    public function changeName(EmailNotificationName $newName)
    {
        if (! $this->name->equals($newName)) {
            $this->name = $newName;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeEmail(EmailNotificationEmail $newEmail)
    {
        if (! $this->email->equals($newEmail)) {
            $this->email = $newEmail;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

}
