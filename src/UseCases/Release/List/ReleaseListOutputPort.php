<?php

namespace ConsulConfigManager\Application\UseCases\Release\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ReleaseListOutputPort
 * @package ConsulConfigManager\Application\UseCases\Release\List
 */
interface ReleaseListOutputPort
{
    /**
     * Output port for "list"
     * @param ReleaseListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(ReleaseListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ReleaseListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ReleaseListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
