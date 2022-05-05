<?php

namespace ConsulConfigManager\Application\Test\Unit;

use ConsulConfigManager\Application\Test\TestCase;
use ConsulConfigManager\Application\ApplicationDomain;

/**
 * Class ApplicationDomainTest
 *
 * @package ConsulConfigManager\Application\Test\Unit
 */
class ApplicationDomainTest extends TestCase
{
    public function testRoutesShouldNotBeRegisteredByDefault(): void
    {
        ApplicationDomain::ignoreRoutes();
        $this->assertFalse(ApplicationDomain::shouldRegisterRoutes());
        ApplicationDomain::registerRoutes();
    }

    public function testRoutesRegistrationCanBeEnabled(): void
    {
        ApplicationDomain::registerRoutes();
        $this->assertTrue(ApplicationDomain::shouldRegisterRoutes());
        ApplicationDomain::ignoreRoutes();
    }
}
