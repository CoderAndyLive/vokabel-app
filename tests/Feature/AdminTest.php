<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create and authenticate an admin user
        $this->admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($this->admin);
    }

    /**
     * Test if the admin dashboard page returns a successful response.
     *
     * @return void
     */
    public function test_admin_dashboard_page_returns_successful_response()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Admin Dashboard');
    }

    /**
     * Test if an admin can create a user.
     *
     * @return void
     */
    public function test_admin_can_create_user()
    {
        $response = $this->post('/admin/users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
        ]);
    }

    /**
     * Test if an admin can update a user.
     *
     * @return void
     */
    public function test_admin_can_update_user()
    {
        $user = User::factory()->create();

        $response = $this->put("/admin/users/{$user->id}", [
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
        ]);
    }

    /**
     * Test if an admin can delete a user.
     *
     * @return void
     */
    public function test_admin_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/admin/users/{$user->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * Test if a non-admin user cannot access the admin dashboard.
     *
     * @return void
     */
    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $this->actingAs(User::factory()->create(['is_admin' => false]));

        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}