<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Domain;

use Faker\Factory;

final class FileMother
{
    private $file;

    private function __construct(string $file)
    {
        $this->file = $file;
    }

    public static function random(): self
    {
        return new self(Factory::create()->file('/tmp', 'tests/Public/Documents'));
    }

    public function file(): string
    {
        return $this->file;
    }

    public function name(): string
    {
        $file_parts = explode('/', $this->file);
        $last = count($file_parts) - 1;

        return $file_parts[$last];
    }

    public function route(): string
    {
        $file_parts = explode('/', $this->file);
        $last = count($file_parts) - 1;
        unset($file_parts[$last]);

        return implode('/', $file_parts);
    }
}
