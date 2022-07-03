<?php namespace Unittests\Test;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
// use 

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function setUp(): void
    {
        parent::setUp();

    }
}
?>