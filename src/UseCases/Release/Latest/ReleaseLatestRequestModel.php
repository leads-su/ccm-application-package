<?php

namespace ConsulConfigManager\Application\UseCases\Release\Latest;

use Illuminate\Http\Request;

/**
 * Class ReleaseLatestRequestModel
 * @package ConsulConfigManager\Application\UseCases\Release\Latest
 */
class ReleaseLatestRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * ReleaseLatestRequestModel constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
