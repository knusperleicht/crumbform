<?php

namespace Knusperleicht\CrumbForm\Tests;


use Knusperleicht\CrumbForm\CrumbFormServiceApiProvider;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [CrumbFormServiceApiProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
