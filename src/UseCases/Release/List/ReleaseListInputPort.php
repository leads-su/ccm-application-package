<?php

namespace ConsulConfigManager\Application\UseCases\Release\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ReleaseListInputPort
 * @package ConsulConfigManager\Application\UseCases\Release\List
 */
interface ReleaseListInputPort
{
    /**
     * Input port for "list"
     * @param ReleaseListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(ReleaseListRequestModel $requestModel): ViewModel;
}
