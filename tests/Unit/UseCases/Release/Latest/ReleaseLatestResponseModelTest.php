<?php

namespace ConsulConfigManager\Application\Test\Unit\UseCases\Release\Latest;

use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestResponseModel;

/**
 * Class ReleaseLatestResponseModelTest
 * @package ConsulConfigManager\Application\Test\Unit\UseCases\Release\Latest
 */
class ReleaseLatestResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfResponseIsReturned(): void
    {
        $instance = new ReleaseLatestResponseModel();
        $this->assertSame([], $instance->getEntity());
    }
}
