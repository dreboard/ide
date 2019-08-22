<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class ApiTest extends TestCase
{

    protected function setUp():void
    {
        parent::setUp();
        $this->uri = 'http://localhost/_PROJECTS/ide/public/requests/api.php';
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/_PROJECTS/ide/public'
        ]);


    }

    public function testApiBasicCall()
    {
        $data = array(
            'uri' => 'http://localhost/_PROJECTS/ide/public/requests/api.php',
            'text' => 'Hello World'
        );
        $ch = curl_init($this->uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data)))
        );

        $result = curl_exec($ch);

        curl_close($ch);
        var_dump($result);
        $this->assertJsonStringEqualsJsonString(
            json_encode(['uri' => $this->uri]),
            $result
        );
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