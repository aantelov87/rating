<?php
/**
 * Created by PhpStorm.
 * User: aantelov
 * Date: 5/24/16
 * Time: 4:40 PM
 */

namespace RatingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testWidget()
    {
        $userWidgetCase = [
            ['9d19a2f4-21a3-11e6-b374-0242ac110003', [200, 'application/javascript; charset=UTF-8', 'function']],
            ['9r19r2r4-21a3-11e6-b374-0242ac110003', [404, 'text/html; charset=UTF-8', 'No route']],
            ['c7b14b9f-21c0-11e6-b374-0242ac110003', [404, 'text/html; charset=UTF-8', 'Resource not found']],
        ];

        foreach($userWidgetCase as $widgetCase){
            $client = static::createClient();
            $expectedResult = $widgetCase[1];
            $client->request('GET', "/widget/{$widgetCase[0]}.js");
            $this->assertSame($expectedResult[0], $client->getResponse()->getStatusCode());
            $this->assertSame($expectedResult[1], $client->getResponse()->headers->get('Content-Type'));
            $this->assertTrue( FALSE !== strpos($client->getResponse()->getContent(), $expectedResult[2]));
        }

    }

    public function testViewRating()
    {
        $userWidgetCase = [
            ['9d19a2f4-21a3-11e6-b374-0242ac110003', [200, 'text/html; charset=UTF-8', '18%']],
            ['7145aec7-21c3-11e6-b374-0242ac110003', [200, 'text/html; charset=UTF-8', '0%']],
            ['9r19r2r4-21a3-11e6-b374-0242ac110003', [404, 'text/html; charset=UTF-8', 'No route']],
            ['c7b14b9f-21c0-11e6-b374-0242ac110003', [404, 'text/html; charset=UTF-8', 'Resource not found']],
        ];

        foreach($userWidgetCase as $widgetCase){
            $client = static::createClient();
            $expectedResult = $widgetCase[1];
            $crawler = $client->request('GET', "/user/{$widgetCase[0]}/rating_average");
            $this->assertSame($expectedResult[0], $client->getResponse()->getStatusCode());
            $this->assertSame($expectedResult[1], $client->getResponse()->headers->get('Content-Type'));
            if ($client->getResponse()->isSuccessful()){
                print $expectedResult[2]."----".$crawler->filter("span.widget-content")->text();
                $this->assertSame($expectedResult[2], $crawler->filter("span.widget-content")->text());
            } else {
                $this->assertTrue( FALSE !== strpos($client->getResponse()->getContent(), $expectedResult[2]));
            }
            

        }

    }
}
