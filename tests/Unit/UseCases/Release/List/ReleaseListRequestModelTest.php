<?php

namespace ConsulConfigManager\Application\Test\Unit\UseCases\Release\List;

use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\UseCases\Release\List\ReleaseListRequestModel;

/**
 * Class ReleaseListRequestModelTest
 * @package ConsulConfigManager\Application\Test\Unit\UseCases\Release\List
 */
class ReleaseListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new ReleaseListRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
