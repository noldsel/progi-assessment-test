<?php 

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    public function testCalculateEndpoint()
    {
        $client = static::createClient();

        // send an api request
        $client->request('POST', '/api/calculate-vehicle-price',
            [], // No query parameters
            [], // No files
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'vehicle_price' => 398.00,
                'vehicle_type'=> 'Common'
            ])
        );

        $this->assertResponseIsSuccessful();
        
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('total_cost', $data);
        $this->assertEquals(550.76, $data['total_cost']);
    }
}
