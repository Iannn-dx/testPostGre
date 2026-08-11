<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertOk();
    $response->assertSee('Create an Account');
    $response->assertSee('Register');
    $response->assertSee('Sign in');
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Maria Santos',
        'email' => 'maria@museum.gov.ph',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('users', [
        'name' => 'Maria Santos',
        'email' => 'maria@museum.gov.ph',
    ]);
});

test('registration requires a unique email', function () {
    User::factory()->create(['email' => 'staff@museum.gov.ph']);

    $response = $this->from('/register')->post('/register', [
        'name' => 'Another Staff',
        'email' => 'staff@museum.gov.ph',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect('/register');
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('registration requires password confirmation', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Maria Santos',
        'email' => 'maria@museum.gov.ph',
        'password' => 'password',
        'password_confirmation' => 'different-password',
    ]);

    $response->assertRedirect('/register');
    $response->assertSessionHasErrors('password');
    $this->assertGuest();
});

test('authenticated users are redirected from registration page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/register');

    $response->assertRedirect(route('dashboard'));
});
