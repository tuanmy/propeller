<?php

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
    }
    
    function testUserNameCanBeChanged()
    {
        // create a user from framework, user will be deleted after the test
        $id = $this->tester->haveRecord('user', ['username' => 'trantuanmy']);
        // access model
        $user = User::find($id);
        // $user->setName('bill');
        // $user->save();
        // $this->assertEquals('bill', $user->getName());
        // // verify data was saved using framework methods
        $this->tester->seeRecord('user', ['username' => 'trantuanmy']);
        //$this->tester->dontSeeRecord('user', ['name' => 'miles']);
    }
}
