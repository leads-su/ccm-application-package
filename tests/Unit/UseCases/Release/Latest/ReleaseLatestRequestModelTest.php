<?php

namespace ConsulConfigManager\Application\Test\Unit\UseCases\Release\Latest;

use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestRequestModel;

/**
 * Class ReleaseLatestRequestModelTest
 * @package ConsulConfigManager\Application\Test\Unit\UseCases\Release\Latest
 */
class ReleaseLatestRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new ReleaseLatestRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
