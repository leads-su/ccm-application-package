<?php

namespace ConsulConfigManager\Application\Presenters\Release;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Application\UseCases\Release\List\ReleaseListOutputPort;
use ConsulConfigManager\Application\UseCases\Release\List\ReleaseListResponseModel;

/**
 * Class ReleaseListHttpPresenter
 * @package ConsulConfigManager\Application\Presenters\Release
 */
class ReleaseListHttpPresenter implements ReleaseListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(ReleaseListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of all available releases',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(ReleaseListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve list of releases',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
