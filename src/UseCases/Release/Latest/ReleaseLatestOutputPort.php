<?php

namespace ConsulConfigManager\Application\UseCases\Release\Latest;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ReleaseLatestOutputPort
 * @package ConsulConfigManager\Application\UseCases\Release\Latest
 */
interface ReleaseLatestOutputPort
{
    /**
     * Output port for "latest"
     * @param ReleaseLatestResponseModel $responseModel
     * @return ViewModel
     */
    public function latest(ReleaseLatestResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ReleaseLatestResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ReleaseLatestResponseModel $responseModel, Throwable $throwable): ViewModel;
}
