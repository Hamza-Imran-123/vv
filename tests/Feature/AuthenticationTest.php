use App\Models\User;

test('Test login screen can be rendered', function () {
    $this->get('/login')->assertStatus(200);
});

test('Test users can authenticate using the login screen', function () {
    // Ensure the user exists in the database
    $user = User::factory()->create([
        'email' => 'user@gmail.com',
        'password' => bcrypt('password'), // Ensure the password is hashed
    ]);

    // Attempt to log in
    $response = $this->post('/login', [
        'email' => 'user@gmail.com',
        'password' => 'password', // The plain text password
    ]);

    // Assert that the user is authenticated
    $this->assertAuthenticatedAs($user);
    // Assert that the user is redirected to the movies page
    $response->assertRedirect('/movies');
});

