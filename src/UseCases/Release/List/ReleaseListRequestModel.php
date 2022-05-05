<?php

namespace ConsulConfigManager\Application\UseCases\Release\List;

use Illuminate\Http\Request;

/**
 * Class ReleaseListRequestModel
 * @package ConsulConfigManager\Application\UseCases\Release\List
 */
class ReleaseListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * ReleaseListRequestModel constructor.
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
