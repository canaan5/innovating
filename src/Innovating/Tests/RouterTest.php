<?php
/**
 * Created by PhpStorm.
 * User: kesty
 * Date: 3/23/16
 * Time: 12:00 AM
 */

namespace Innovating\Tests;

class RouterTest extends TestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testGetRouter()
    {
        $response = $this->client->get('/test');
        $this->assertEquals(200, $response->getStatusCode());
    }

}