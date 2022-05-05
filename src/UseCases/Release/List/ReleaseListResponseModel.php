<?php

namespace ConsulConfigManager\Application\UseCases\Release\List;

use Illuminate\Support\Collection;

/**
 * Class ReleaseListResponseModel
 * @package ConsulConfigManager\Application\UseCases\Release\List
 */
class ReleaseListResponseModel
{
    /**
     * Collection of entities
     * @var Collection
     */
    private Collection $entities;

    /**
     * ReleaseListResponseModel constructor.
     * @param Collection|array $entities
     * @return void
     */
    public function __construct(Collection|array $entities = [])
    {
        if (is_array($entities)) {
            $entities = collect($entities);
        }
        $this->entities = $entities;
    }

    /**
     * Get collection of entities
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }
}
