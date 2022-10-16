<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\Entity;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryCode;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryEmail;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryMessage;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryName;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryPhone;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryStatus;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryType;
use Shared\Domain\ValueObjects\DateTimeValueObject;

final class EmailHistory
{
    private function __construct(
        private EmailHistoryId $id,
        private EmailHistoryCode $code,
        private EmailHistoryName $name,
        private EmailHistoryEmail $email,
        private EmailHistoryPhone $phone,
        private EmailHistoryMessage $message,
        private EmailHistoryType $type,
        private EmailHistoryStatus $status,
        private DateTimeValueObject $createdAt,
        private DateTimeValueObject $updatedAt
    ) {
    }

    public static function create(
        EmailHistoryId $id,
        EmailHistoryCode $code,
        EmailHistoryName $name,
        EmailHistoryEmail $email,
        EmailHistoryPhone $phone,
        EmailHistoryMessage $message,
        EmailHistoryType $type,
    ): self {
        return new self(
            $id,
            $code,
            $name,
            $email,
            $phone,
            $message,
            $type,
            new EmailHistoryStatus(),
            new DateTimeValueObject(),
            new DateTimeValueObject()
        );
    }

    public static function fromPrimitives(
        string $id,
        string $code,
        string $name,
        string $email,
        string $phone,
        string $message,
        string $type,
        string $status,
        string $createdAt,
        string $updatedAt
    ): self {
        return new self(
            new EmailHistoryId($id),
            new EmailHistoryCode($code),
            new EmailHistoryName($name),
            new EmailHistoryEmail($email),
            new EmailHistoryPhone($phone),
            new EmailHistoryMessage($message),
            new EmailHistoryType($type),
            new EmailHistoryStatus($status),
            new DateTimeValueObject($createdAt),
            new DateTimeValueObject($updatedAt)
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'code' => $this->code()->value(),
            'name' => $this->name()->value(),
            'email' => $this->email()->value(),
            'phone' => $this->phone()->value(),
            'message' => $this->message()->value(),
            'type' => $this->type()->value(),
            'status' => $this->status()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()->value(),
        ];
    }

    public function id(): EmailHistoryId
    {
        return $this->id;
    }

    public function code(): EmailHistoryCode
    {
        return $this->code;
    }

    public function name(): EmailHistoryName
    {
        return $this->name;
    }

    public function email(): EmailHistoryEmail
    {
        return $this->email;
    }

    public function phone(): EmailHistoryPhone
    {
        return $this->phone;
    }

    public function message(): EmailHistoryMessage
    {
        return $this->message;
    }

    public function type(): EmailHistoryType
    {
        return $this->type;
    }

    public function status(): EmailHistoryStatus
    {
        return $this->status;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }
}
