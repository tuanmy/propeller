<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Propeller');
    }
    // public function testloginExample()
    // {
    //     $this->visit('/login')
    //           ->type('tuanmythkt@gmail.com','email')
    //           ->type('@dmin1234','password')
    //           ->press('Login');
            
    // }

    
}
