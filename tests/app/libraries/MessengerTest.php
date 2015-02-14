<?php

namespace Libraries;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-02-10 at 12:43:11.
 */
class MessengerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Messenger
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Messenger;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * @covers Libraries\Messenger::get
     */
    public function testGet() {
        
        $this->assertTrue(is_array( $this->object->get() ) );
    }

    /**
     * @covers Libraries\Messenger::info
     * @depends testGet
     */
    public function testInfo() {

        $message = 'test info';
        
        $this->object->info($message);
        
        $warning = $this->object->get();
        
        $this->assertSame($warning[0]['level'], Messenger::INFO);
        $this->assertSame($warning[0]['message'], $message);
    }

    /**
     * @covers Libraries\Messenger::warning
     * @depends testGet
     */
    public function testWarning() {
        
        $message = 'test warning';
        $this->object->warning($message);
        
        $warning = $this->object->get();
        
        $this->assertSame($warning[0]['level'], Messenger::WARNING);
        $this->assertSame($warning[0]['message'], $message);
    }
    
    public function testMessage() {
        $message = 'test message';
        $this->object->message(0, $message);
        
        $warning = $this->object->get();
        
        $this->assertSame($warning[0]['level'], 0);
        $this->assertSame($warning[0]['message'], $message);        
    }

}