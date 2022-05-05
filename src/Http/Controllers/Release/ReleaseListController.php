<?php

namespace ConsulConfigManager\Application\Http\Controllers\Release;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Application\UseCases\Release\List\ReleaseListInputPort;
use ConsulConfigManager\Application\UseCases\Release\List\ReleaseListRequestModel;

/**
 * Class ReleaseListController
 * @package ConsulConfigManager\Application\Http\Controllers\Release
 */
class ReleaseListController extends Controller
{
    /**
     * Input port interactor instance
     * @var ReleaseListInputPort
     */
    private ReleaseListInputPort $interactor;

    /**
     * ReleaseListController constructor.
     * @param ReleaseListInputPort $interactor
     * @return void
     */
    public function __construct(ReleaseListInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request): ?Response
    {
        $viewModel = $this->interactor->list(
            new ReleaseListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
