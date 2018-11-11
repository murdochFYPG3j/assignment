<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class ForgotPasswordTest extends TestCase
{
    public function test_forgot_password()
    {
    	$user = User::first();

        $this->post('/reset-password', ['email' => $user->email])->dump();
    }
}
