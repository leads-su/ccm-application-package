<?php

namespace ConsulConfigManager\Application\UseCases\Release\Latest;

use Throwable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Application\Services\Service;
use ConsulConfigManager\Application\Exceptions\InvalidProviderException;

/**
 * Class ReleaseLatestInteractor
 * @package ConsulConfigManager\Application\UseCases\Release\Latest
 */
class ReleaseLatestInteractor implements ReleaseLatestInputPort
{
    /**
     * Indicates whether caching is enabled
     * @var bool
     */
    private bool $cacheEnabled;

    /**
     * Cache key used to cache response
     * @var string
     */
    private string $cacheKey;

    /**
     * Output port instance
     * @var ReleaseLatestOutputPort
     */
    private ReleaseLatestOutputPort $output;

    /**
     * Service instance
     * @var Service
     */
    private Service $service;

    /**
     * ReleaseLatestInteractor constructor.
     * @param ReleaseLatestOutputPort $output
     * @return void
     */
    public function __construct(ReleaseLatestOutputPort $output)
    {
        $this->cacheEnabled = config('domain.application.caching.enabled', false);
        $this->cacheKey = config('domain.application.caching.keys.release.latest', 'ccm::application::release:list');
        $this->output = $output;
        $this->service = new Service();
    }

    /**
     * @inheritDoc
     */
    public function latest(ReleaseLatestRequestModel $requestModel): ViewModel
    {
        try {
            if ($this->cacheEnabled) {
                $response = $this->handleCachedResponse();
            } else {
                $response = $this->handleCachelessResponse();
            }
            return $this->output->latest(new ReleaseLatestResponseModel($response));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new ReleaseLatestResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * Handle response with cache
     * @return array
     */
    private function handleCachedResponse(): array
    {
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        }
        $cachePeriod = Carbon::now()->addMinutes(config('domain.application.caching.cache_time', 15));
        return Cache::remember($this->cacheKey, $cachePeriod, function (): array {
            return $this->handleCachelessResponse();
        });
    }

    /**
     * Handle response without cache
     * @return array
     * @throws InvalidProviderException
     */
    private function handleCachelessResponse(): array
    {
        return $this->service->client()->getLatestRelease()->toArray();
    }
}
