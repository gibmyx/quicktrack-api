<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Shared\Domain\Errors;

abstract class TestCase extends BaseTestCase
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
