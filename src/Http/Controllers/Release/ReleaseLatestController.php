<?php

namespace ConsulConfigManager\Application\Http\Controllers\Release;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestInputPort;
use ConsulConfigManager\Application\UseCases\Release\Latest\ReleaseLatestRequestModel;

/**
 * Class ReleaseLatestController
 * @package ConsulConfigManager\Application\Http\Controllers\Release
 */
class ReleaseLatestController extends Controller
{
    /**
     * Input port interactor instance
     * @var ReleaseLatestInputPort
     */
    private ReleaseLatestInputPort $interactor;

    /**
     * ReleaseLatestController constructor.
     * @param ReleaseLatestInputPort $interactor
     * @return void
     */
    public function __construct(ReleaseLatestInputPort $interactor)
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
        $viewModel = $this->interactor->latest(
            new ReleaseLatestRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
