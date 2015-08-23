<?php

use App\User;
class ExampleTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {

    }

    function testUserNameCanBeChanged()
    {
        // create a user from framework, user will be deleted after the test
        //$id = $this->tester->haveRecord('user', ['username' => 'trantuanmy12']);
        //$id = $this->haveRecordUuid('User',['username' => 'trantuanmy12'])
        $user = User::create([
            'username' => 'trantuanmy12'
        ]);
        // access model
        $user = User::find($user->id);
        // $user->setName('bill');
        // $user->save();
        // $this->assertEquals('bill', $user->getName());
        // // verify data was saved using framework methods
        $this->tester->seeRecord('user', ['username' => 'trantuanmy12']);
        //$this->tester->dontSeeRecord('user', ['name' => 'miles']);
    }

    private function haveRecordUuid($model, $attributes = array())
    {
        return $this->app['db']->table($model)->insert($attributes);
    }
}
