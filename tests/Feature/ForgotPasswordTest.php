<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Mail;
use App\Mail\ResetPassword;

class ForgotPasswordTest extends TestCase
{
    public function test_forgot_password()
    {
    	Mail::fake();

    	$user = User::first();

        $this->post('/auth/reset-password', ['email' => $user->email])->assertOk();

        Mail::assertSent(ResetPassword::class);
    }
}
