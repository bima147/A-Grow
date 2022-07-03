<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCorrectDirectRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel')
                    ->clickLink('Register')
                    ->assertSee('Register');
        });
    }

    public function testEmptyAll()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->press('Register')
                    ->assertSee('The name field is required.')
                    ->assertSee('The phone field is required.')
                    ->assertSee('The address field is required.')
                    ->assertSee('The email field is required.')
                    ->assertSee('The password field is required.');
        });
    }

    public function testEmptyName()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The name field is required.');
        });
    }

    public function testEmptyPhone()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The phone field is required.');
        });
    }

    public function testPhoneLessThanTen()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '0')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The phone must be at least 10.');
        });
    }

    public function testPhoneIsNotNumber()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', 'aaaa')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The phone must be a number.');
        });
    }

    public function testEmptyAddress()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The address field is required.');
        });
    }

    public function testEmptyEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The email field is required.');
        });
    }

    public function testEmptyPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The password field is required.');
        });
    }

    public function testPasswordLessThanEight()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test')
                    ->type('password_confirmation', 'test')
                    ->press('Register')
                    ->assertSee('The password must be at least 8 characters.');
        });
    }

    public function testEmptyConfirmationPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->press('Register')
                    ->assertSee('The password confirmation does not match.');
        });
    }

    public function testCorrectRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->seeLink('/login');
        });
    }

    public function testEmailHaveASameValue()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Register')
                    ->type('name', 'test')
                    ->type('phone', '081234567890')
                    ->type('address', 'jalan')
                    ->type('email', 'test@test.test')
                    ->type('password', 'test1234')
                    ->type('password_confirmation', 'test1234')
                    ->press('Register')
                    ->assertSee('The email has already been taken.');
        });
    }
}
