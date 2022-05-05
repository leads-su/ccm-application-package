<?php

namespace ConsulConfigManager\Application\Presenters\Release;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestOutputPort;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestResponseModel;

/**
 * Class ReleaseLatestHttpPresenter
 * @package ConsulConfigManager\Application\Presenters\Release
 */
class ReleaseLatestHttpPresenter implements ReleaseLatestOutputPort
{
    /**
     * @inheritDoc
     */
    public function latest(ReleaseLatestResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully fetched latest release information',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(ReleaseLatestResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve latest release',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
