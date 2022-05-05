<?php

namespace ConsulConfigManager\Application\UseCases\Release\Latest;

/**
 * Class ReleaseLatestResponseModel
 * @package ConsulConfigManager\Application\UseCases\Release\Latest
 */
class ReleaseLatestResponseModel
{
    /**
     * Entity instance
     * @var array|null
     */
    private array|null $entity;

    /**
     * ReleaseLatestResponseModel constructor.
     * @param array|null $entity
     * @return void
     */
    public function __construct(array|null $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity
     * @return array
     */
    public function getEntity(): array
    {
        if ($this->entity === null) {
            return [];
        }
        return $this->entity;
    }
}
