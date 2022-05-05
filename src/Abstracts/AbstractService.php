<?php

namespace ConsulConfigManager\Application\Abstracts;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use ConsulConfigManager\Application\Entities\ReleaseEntity;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class AbstractService
 * @package ConsulConfigManager\Application\Abstracts
 */
abstract class AbstractService
{
    /**
     * Name of service
     * @var string
     */
    protected string $service;

    /**
     * Endpoint path for repository releases
     * @var string
     */
    protected string $releasesPath;

    /**
     * Pending Request instance
     * @var PendingRequest
     */
    private PendingRequest $client;

    /**
     * AbstractService constructor.
     * @param PendingRequest|null $client
     * @return void
     */
    public function __construct(?PendingRequest $client = null)
    {
        if ($client !== null) {
            $this->client = $client;
        } else {
            $this->client = Http::baseUrl($this->buildEndpointString())
                ->withToken(
                    $this->resolveAccessToken(),
                    $this->resolveAccessTokenType(),
                )->timeout(10);
        }
    }

    /**
     * Get Pending Request instance
     * @return PendingRequest
     */
    public function getClient(): PendingRequest
    {
        return $this->client;
    }

    /**
     * Get list of releases
     * @return array
     * @throws InvalidProviderException
     */
    public function getReleases(): array
    {
        $response = $this->getClient()->get(sprintf(
            '%s/%s',
            $this->buildRepositoryString(),
            $this->releasesPath,
        ))->json();

        return array_map(function (array $release): ReleaseEntity {
            return new ReleaseEntity($this->service, $release);
        }, $response);
    }

    /**
     * Get latest release
     * @return ReleaseEntity
     * @throws InvalidProviderException
     */
    public function getLatestRelease(): ReleaseEntity
    {
        return Arr::first($this->getReleases());
    }

    /**
     * Build service specific endpoint string
     * @return string
     */
    abstract protected function buildEndpointString(): string;

    /**
     * Build repository path string
     * @return string
     */
    abstract protected function buildRepositoryString(): string;

    /**
     * Resolve access token used to access service
     * @return string
     */
    private function resolveAccessToken(): string
    {
        return config(sprintf('domain.application.providers.%s.token.value', $this->service));
    }

    /**
     * Resolve access token type
     * @return string
     */
    private function resolveAccessTokenType(): string
    {
        return config(sprintf('domain.application.providers.%s.token.type', $this->service));
    }
}
