<?php

namespace ConsulConfigManager\Application\Services\GitLab;

use ConsulConfigManager\Application\Abstracts\AbstractService;

/**
 * Class Service
 * @package ConsulConfigManager\Application\Services\GitLab
 */
class Service extends AbstractService
{
    /**
     * @inheritDoc
     */
    protected string $service = 'gitlab';

    /**
     * @inheritDoc
     */
    protected string $releasesPath = 'releases';

    /**
     * @inheritDoc
     */
    protected function buildEndpointString(): string
    {
        return sprintf('%s/api/v4/projects/', config('domain.application.providers.gitlab.url', 'https://gitlab.com'));
    }

    /**
     * @inheritDoc
     */
    protected function buildRepositoryString(): string
    {
        return urlencode(sprintf(
            '%s/%s',
            config('domain.application.owner', 'example'),
            config('domain.application.repository', 'example'),
        ));
    }
}
