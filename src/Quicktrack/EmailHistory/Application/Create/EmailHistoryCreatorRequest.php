<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Application\Create;

final class EmailHistoryCreatorRequest
{
    public function __construct(
        private string $id,
        private string $code,
        private string $name,
        private string $email,
        private string $phone,
        private string $message,
        private string $type
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function type(): string
    {
        return $this->type;
    }
}
