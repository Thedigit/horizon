<?php

namespace Thedigit\Horizon\Tests\Controller;

use Thedigit\Horizon\Horizon;
use Thedigit\Horizon\Tests\IntegrationTest;

abstract class AbstractControllerTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');

        Horizon::auth(function () {
            return true;
        });
    }
}
