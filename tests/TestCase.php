<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Shared\Domain\Errors;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
