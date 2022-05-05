<?php

namespace ConsulConfigManager\Application\Services;

use ConsulConfigManager\Application\Abstracts\AbstractService;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class Service
 * @package ConsulConfigManager\Application\Services
 */
class Service
{
    /**
     * Provider in use
     * @var string
     */
    private string $provider;

    /**
     * Service for currently used provider
     * @var AbstractService
     */
    private AbstractService $service;

    /**
     * Service constructor.
     * @return void
     * @throws InvalidProviderException
     */
    public function __construct()
    {
        $this->provider = config('domain.application.provider');
        $this->bootstrap();
    }

    /**
     * Get service client
     * @return AbstractService
     */
    public function client(): AbstractService
    {
        return $this->service;
    }

    /**
     * Get currently used provider
     * @return string
     */
    private function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * Bootstrap class
     * @return void
     * @throws InvalidProviderException
     */
    private function bootstrap(): void
    {
        switch ($this->getProvider()) {
            case 'gitlab':
                $this->service = new \ConsulConfigManager\Application\Services\GitLab\Service();
                break;
            case 'github':
                $this->service = new \ConsulConfigManager\Application\Services\GitHub\Service();
                break;
            default:
                throw new InvalidProviderException(sprintf('Provider `%s` is not supported', $this->getProvider()));
        }
    }
}
