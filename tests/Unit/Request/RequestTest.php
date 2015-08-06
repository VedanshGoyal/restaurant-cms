<?php

namespace Tests\Unit\Requests;

use Mockery as m;

class RequestTest extends \TestCase
{
    public function setUp()
    {
        $this->request = new TestRequest();
    }

    public function tearDown()
    {
        m::close();
    }

    public function testRulesReturnsMergedRulesWithAllowedMethod()
    {
        $reflection = new \ReflectionClass($this->request);
        $property = $reflection->getProperty('method');
        $property->setAccessible(true);
        $property->setValue($this->request, 'GET');

        $expected = ['test' => 'rules', 'get' => 'rules'];
        $rules = $this->request->rules();

        $this->assertEquals($expected, $rules);
    }

    public function testRulesReturnsDefaultRulesWithNotAllowedMethod()
    {
        $reflection = new \ReflectionClass($this->request);
        $property = $reflection->getProperty('method');
        $property->setAccessible(true);
        $property->setValue($this->request, 'PATCH');

        $expected = ['test' => 'rules'];
        $rules = $this->request->rules();

        $this->assertEquals($expected, $rules);
    }

    public function testIsMethodAllowedReturnsTrueInArray()
    {
        $method = $this->getProtectedMethod('isMethodAllowed');

        $this->assertTrue($method->invokeArgs($this->request, ['get']));
        $this->assertTrue($method->invokeArgs($this->request, ['post']));
        $this->assertTrue($method->invokeArgs($this->request, ['put']));
        $this->assertTrue($method->invokeArgs($this->request, ['delete']));
    }

    public function testIsMethodAllowedReturnsFalseNotInArray()
    {
        $method = $this->getProtectedMethod('isMethodAllowed');

        $this->assertFalse($method->invokeArgs($this->request, ['patch']));
        $this->assertFalse($method->invokeArgs($this->request, ['options']));
        $this->assertFalse($method->invokeArgs($this->request, ['something']));
        $this->assertFalse($method->invokeArgs($this->request, ['pewpew']));
    }

    public function testHasAltRulesReturnsTrueWhenHasRules()
    {
        $method = $this->getProtectedMethod('hasAltRules');

        $this->assertTrue($method->invokeArgs($this->request, ['get']));
        $this->assertTrue($method->invokeArgs($this->request, ['post']));
        $this->assertTrue($method->invokeArgs($this->request, ['put']));
        $this->assertTrue($method->invokeArgs($this->request, ['delete']));
    }

    public function testHasAltRulesReturnsFalseWhenNoRules()
    {
        $method = $this->getProtectedMethod('hasAltRules');

        $this->assertFalse($method->invokeArgs($this->request, ['patch']));
        $this->assertFalse($method->invokeArgs($this->request, ['options']));
        $this->assertFalse($method->invokeArgs($this->request, ['something']));
        $this->assertFalse($method->invokeArgs($this->request, ['pewpew']));
    }

    public function testGetAltRulesReturnsMatching()
    {
        $method = $this->getProtectedMethod('getAltRules');
        $expected = ['test' => 'rules', 'get' => 'rules'];
        $rules = $method->invokeArgs($this->request, ['get']);

        $this->assertEquals($expected, $rules);

    }

    protected function getProtectedMethod($methodName)
    {
        $class = new \ReflectionClass($this->request);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }
}
