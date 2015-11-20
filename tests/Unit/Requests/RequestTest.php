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

    public function testRulesReturnsRulesArrayWhenMethodInValidateMethodsArray()
    {
        $rules = ['test' => 'rules'];

        $this->request->setMethod('POST');
        $this->assertEquals($rules, $this->request->rules());
        $this->request->setMethod('PUT');
        $this->assertEquals($rules, $this->request->rules());
    }

    public function testRulesReturnsEmptyArrayWhenMethodNotInValidateMethodsArray()
    {
        $this->request->setMethod('GET');
        $this->assertEquals([], $this->request->rules());
        $this->request->setMethod('DELETE');
        $this->assertEquals([], $this->request->rules());
    }
}
