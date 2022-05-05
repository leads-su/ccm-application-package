<?php

namespace ConsulConfigManager\Application\Test;

use ReflectionClass;
use ReflectionException;
use Illuminate\Foundation\Application;
use ConsulConfigManager\Application\ApplicationDomain;
use ConsulConfigManager\Application\Providers\ApplicationServiceProvider;

/**
 * Class TestCase
 * @package ConsulConfigManager\Application\Test
 */
abstract class TestCase extends \ConsulConfigManager\Testing\TestCase
{
    /**
     * @inheritDoc
     */
    protected array $packageProviders = [
        ApplicationServiceProvider::class,
    ];

    /**
     * @inheritDoc
     */
    protected bool $configurationFromEnvironment = true;

    /**
     * @inheritDoc
     */
    protected string $configurationFromFile = __DIR__ . '/..';

    /**
     * @inheritDoc
     */
    public function runBeforeSetUp(): void
    {
        ApplicationDomain::registerRoutes();
    }

    /**
     * @inheritDoc
     */
    public function runAfterSetUp(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function runBeforeTearDown(): void
    {
        ApplicationDomain::ignoreRoutes();
    }

    /**
     * @inheritDoc
     */
    public function setUpEnvironment(Application $app): void
    {
    }

    /**
     * Call non-public method
     * @param $object
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws ReflectionException
     */
    protected function callMethod($object, string $name, array $arguments = []): mixed
    {
        $class = new ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $arguments);
    }
}
