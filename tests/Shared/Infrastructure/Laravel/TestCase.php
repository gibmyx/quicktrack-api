<?php

namespace Tests\Shared\Infrastructure\Laravel;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Shared\Domain\Errors;
use Tests\CreatesApplication;
use Tests\TestCase as LaravelTestCase;

abstract class TestCase extends LaravelTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        if (Errors::getInstance()->hasErrors()) {
            Errors::getInstance()->clear();
        }
    }
}
