<?php

namespace Knusperleicht\CrumbForm\Tests;


use Knusperleicht\CrumbForm\CrumbFormServiceProvider;
use PHPUnit\Framework\TestCase;

class CrumbFormTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [CrumbFormServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
