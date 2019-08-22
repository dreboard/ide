<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{

    protected function setUp():void
    {
        parent::setUp();
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/_PROJECTS/ide/public'
        ]);
    }

    public function testClassesDirectoryExists()
    {
        $this->assertDirectoryExists(__DIR__.'/../../app');
    }

    public function testCodeObjectIsInstantiated()
    {
        $code = new App\Core\Code();
        $this->assertIsObject($code);
    }

    public function testHasDatabaseInstance(): void
    {
        $this->assertClassHasAttribute('db', App\Core\Code::class);
    }

    public function testGetCodeSelect()
    {
        $code = new App\Core\Code();
        $result = $code->search('Hello World');
        $this->assertContains('Hello World', $result);
    }


    public function testRequiredInputs()
    {
        //var_dump(getenv('BASE_URL'));

        $client = new Client([
            'base_uri' => 'http://localhost/_PROJECTS/ide/public/'
        ]);
        $data = [
            'test' => 19
        ];

        $response = $client->request('POST', 'requests/code.php', [
            $data //json_encode($data)
        ]);
        var_dump($response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello World', (string)$response->getBody());
        //$this->assertTrue($response->hasHeader('Location'));
    }



}