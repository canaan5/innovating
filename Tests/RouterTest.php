<?php
use GuzzleHttp\Client;

/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/13/16
 * Time: 2:49 AM.
 */

class RouterTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->client = new Client(['base_uri' => 'http://innovating.dev/']);
    }
    public function testHome()
    {
        $request = $this->client->get('/test');
        $this->assertEquals("testing", $request->getBody());
    }

    public function testGet()
    {
        $r = $this->client->get('/test');
        $this->assertEquals(200, $r->getStatusCode());
        $this->assertEquals('testing', $r->getBody());
        $this->assertEquals('1.0', $r->getProtocolVersion());
        $this->assertEquals('OK', $r->getReasonPhrase());
        $this->assertNotEquals(array(), $r->getHeaders());
        $this->assertEquals(['text/html; charset=UTF-8'], $r->getHeader('Content-Type'));
    }
}
