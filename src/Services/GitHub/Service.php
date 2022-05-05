<?php

namespace ConsulConfigManager\Application\Services\GitHub;

use ConsulConfigManager\Application\Abstracts\AbstractService;

/**
 * Class Service
 * @package ConsulConfigManager\Application\Services\GitHub
 */
class Service extends AbstractService
{
    /**
     * @inheritDoc
     */
    protected string $service = 'github';

    /**
     * @inheritDoc
     */
    protected string $releasesPath = 'releases';

    /**
     * @inheritDoc
     */
    protected function buildEndpointString(): string
    {
        return sprintf('%s/repos/', config('domain.application.providers.github.url', 'https://api.github.com'));
    }

    /**
     * @inheritDoc
     */
    protected function buildRepositoryString(): string
    {
        return sprintf(
            '%s/%s',
            config('domain.application.owner', 'example'),
            config('domain.application.repository', 'example'),
        );
    }
}
