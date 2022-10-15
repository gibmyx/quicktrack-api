<?php

namespace Tests\Shared\Infrastructure\Laravel;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Shared\Domain\Errors;
use Tests\TestCase as LaravelTestCase;

abstract class TestCase extends LaravelTestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        if (Errors::getInstance()->hasErrors()) {
            Errors::getInstance()->clear();
        }
    }
}
