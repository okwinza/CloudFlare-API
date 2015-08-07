<?php
namespace okw\CF;

class CloudFlareTest extends \PHPUnit_Framework_TestCase {


    public function testCanBeInitialized(){
        $client = new CF('fake@email.com', 'fakeToken');

        $this->assertInstanceOf('okw\CF\CF', $client);
    }

    public function testBadCredentialsException(){

        $this->setExpectedException('okw\CF\Exception\BadResponseException');

        $client = new CF('fake@email.com', 'fakeToken');

        $client->rec_new(array(
                'z'       => 'yoursite.com',
                'name'    => 'new.yoursite.com',
                'ttl'     => 1,
                'type'    => 'A',
                'content' => '1.2.3.4'
            ));
    }

    public function testBuildRequestParametersClientMode(){

        $client = new CF('fake@email.com', 'fakeToken');

        $params[] = 'rec_new';
        $params[] = array(
            'z'       => 'yoursite.com',
            'name'    => 'new.yoursite.com',
            'ttl'     => 1,
            'type'    => 'A',
            'content' => '1.2.3.4'
        );

        $actual = $this->invokeMethod($client, 'buildRequestParams', $params);

        $expected = array(
            'z'       => 'yoursite.com',
            'name'    => 'new.yoursite.com',
            'ttl'     => 1,
            'type'    => 'A',
            'content' => '1.2.3.4',
            'email'   => 'fake@email.com',
            'tkn'     => 'fakeToken',
            'a'       => 'rec_new',
        );

        $this->assertEquals($expected,$actual);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}