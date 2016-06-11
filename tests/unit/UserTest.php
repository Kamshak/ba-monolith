<?php


use App\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testRegister()
    {
        Artisan::call('migrate'); // Set up In-Memory Database

        $email = 'johndoe@example.com';
        $password = Hash::make('password');

        User::register(['email' => $email, 'password' => $password]);

        $this->tester->seeRecord('users', ['email' => $email, 'password' => $password]);
    }
}
