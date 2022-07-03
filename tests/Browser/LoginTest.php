<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCorrectLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->seeLink('/home');
        });
    }

    public function testCorrectLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                    ->seeLink('Logout')
                    ->click('logout');
        });
    }

    public function testIncorrectLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'test@test.test')
                    ->type('password', '123')
                    ->assertSee('These credentials do not match our records.');
        });
    }

    public function testEmptyPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'test@test.test')
                    ->assertSee('The password field is required.');
        });
    }

    public function testIncorrectEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'test')
                    ->type('password', 'test1234')
                    ->assertSee('These credentials do not match our records.');
        });
    }
}
