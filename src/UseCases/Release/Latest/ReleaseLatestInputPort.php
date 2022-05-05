<?php

namespace ConsulConfigManager\Application\UseCases\Release\Latest;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ReleaseLatestInputPort
 * @package ConsulConfigManager\Application\UseCases\Release\Latest
 */
interface ReleaseLatestInputPort
{
    /**
     * Input port for "latest"
     * @param ReleaseLatestRequestModel $requestModel
     * @return ViewModel
     */
    public function latest(ReleaseLatestRequestModel $requestModel): ViewModel;
}
