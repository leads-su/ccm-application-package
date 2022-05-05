<?php

namespace ConsulConfigManager\Application\Test\Unit\Services\GitHub;

use ReflectionException;
use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\Services\GitHub\Service;
use ConsulConfigManager\Application\Abstracts\AbstractService;

/**
 * Class ServiceTest
 * @package ConsulConfigManager\Application\Test\Unit\Services\GitHub
 */
class ServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceCanBeCreated(): void
    {
        $this->assertInstanceOf(AbstractService::class, $this->createInstance());
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function testShouldPassIfValidDataReturnedFromBuildEndpointString(): void
    {
        $instance = $this->createInstance();
        $response = $this->callMethod($instance, 'buildEndpointString');
        $this->assertSame('https://api.github.com/repos/', $response);
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function testShouldPassIfValidDataReturnedFromBuildRepositoryString(): void
    {
        $instance = $this->createInstance();
        $response = $this->callMethod($instance, 'buildRepositoryString');
        $this->assertSame('example/example', $response);
    }

    /**
     * Create new service instance
     * @return Service
     */
    private function createInstance(): Service
    {
        return new Service();
    }
}
