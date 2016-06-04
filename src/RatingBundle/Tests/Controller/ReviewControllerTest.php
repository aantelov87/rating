<?php

namespace RatingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ReviewsControllerTest.
 *
 * @author Antonio Antelo Vazquez (aantelov87[at]gmail.com)
 */
class ReviewControllerTest extends WebTestCase
{
    public function dataNewReviews() {
        return [
                [
                    [
                    'user' => '9d19a2f4-21a3-11e6-b374-0242ac110003',
                    'comments' => 'Testing comments 1',
                    'rating' => '18'
                    ],
                    201
                ],
                [
                    [
                        'user' => '9d19a2f4-21a3-11e6-b374-0242ac110003',
                        'comments' => '',
                        'rating' => '19'
                    ],
                    400
                ],
                [
                    [
                        'user' => '9d19a2f4-21a3-11e6-b374-0242ac110003',
                        'comments' => 'Testing' ,
                    ],
                    400
                ],
                [
                    [
                        'comments' => 'Testing' ,
                        'rating' => '18'
                    ],
                    400
                ],
                [
                    [
                        'user' => 'c7b14b9f-21c0-11e6-b374-0242ac110003',
                        'comments' => 'Testing comments',
                        'rating' => '18'
                    ],
                    201
                ]
        ];
    }

    /**
     * @dataProvider dataNewReviews
     */
    public function testNewAction($postParams, $expected){
        $client = static::createClient();

        $client->request('POST', "/reviews/", $postParams, array(), array(
            'X-API-TOKEN' => 'wGHkZpq43veHysyxKnrJkDxV',
            'HTTP_ACCEPT' => 'application/x-www-form-urlencoded',
            'HTTP_CONTENT_TYPE' => 'application/x-www-form-urlencoded',
        ));
        $this->assertSame($expected, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider editReviews
     */
/*    public function testEditAction($postParams, $expected){
        $client = static::createClient();

        $client->request('GET', "/reviews/", $postParams, array(),    array(
            'X-API-TOKEN'          => 'wGHkZpq43veHysyxKnrJkDxV',
        ));
        $this->assertSame($expected, $client->getResponse()->getStatusCode());
    }
*/

}
