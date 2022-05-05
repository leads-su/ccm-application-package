<?php

namespace ConsulConfigManager\Application\Test\Unit\Services;

use ReflectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\Services\Service;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class ServiceTest
 * @package ConsulConfigManager\Application\Test\Unit\Services
 */
class ServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfPendingRequestInstanceIsReturned(): void
    {
        $client = Http::baseUrl('https://google.com');
        $instance = new \ConsulConfigManager\Application\Services\GitLab\Service($client);
        $this->assertInstanceOf(PendingRequest::class, $instance->getClient());
    }

    /**
     * @return void
     */
    public function testShouldPassIfExceptionThrownForInvalidProvider(): void
    {
        $this->expectException(InvalidProviderException::class);
        $this->setConfigurationValue('domain.application.provider', 'invalid', $this->app);
        $this->createInstance();
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function testShouldPassIfInstanceCanBeCreatedForGitlab(): void
    {
        $this->setConfigurationValue('domain.application.provider', 'gitlab', $this->app);
        $instance = $this->createInstance();
        $this->assertInstanceOf(Service::class, $instance);
        $this->assertSame('gitlab', $this->callMethod($instance, 'getProvider'));
    }

    /**
     * @return void
     * @throws ReflectionException
     */
    public function testShouldPassIfInstanceCanBeCreatedForGithub(): void
    {
        $this->setConfigurationValue('domain.application.provider', 'github', $this->app);
        $instance = $this->createInstance();
        $this->assertInstanceOf(Service::class, $instance);
        $this->assertSame('github', $this->callMethod($instance, 'getProvider'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetClientForGitlab(): void
    {
        $this->setConfigurationValue('domain.application.provider', 'gitlab', $this->app);
        $instance = $this->createInstance();
        $this->assertInstanceOf(\ConsulConfigManager\Application\Services\GitLab\Service::class, $instance->client());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetClientForGithub(): void
    {
        $this->setConfigurationValue('domain.application.provider', 'github', $this->app);
        $instance = $this->createInstance();
        $this->assertInstanceOf(\ConsulConfigManager\Application\Services\GitHub\Service::class, $instance->client());
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
