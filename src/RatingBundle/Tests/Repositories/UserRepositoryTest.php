<?php
namespace RatingBundle\Tests\Repositories;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
/**
 * Created by PhpStorm.
 * User: aantelov
 * Date: 5/24/16
 * Time: 12:47 PM
 */
class UserRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByCategoryName()
    {
        $products = $this->em
            ->getRepository('AppBundle:Product')
            ->searchByCategoryName('foo')
        ;

        $this->assertCount(1, $products);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }

}
