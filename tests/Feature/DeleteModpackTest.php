<?php

/*
 * This file is part of Solder.
 *
 * (c) Kyle Klaus <kklaus@indemnity83.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Feature;

use App\User;
use App\Modpack;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteModpackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_a_modpack()
    {
        $user = factory(User::class)->create();
        $modpack = factory(Modpack::class)->create(['slug' => 'brothers-klaus']);
        $this->assertEquals(1, Modpack::count());

        $response = $this->actingAs($user)->delete('/modpacks/brothers-klaus');

        $response->assertRedirect('/');
        $this->assertEquals(0, Modpack::count());
    }

    /** @test */
    public function a_guest_cannot_delete_a_modpack()
    {
        $modpack = factory(Modpack::class)->create(['slug' => 'brothers-klaus']);
        $this->assertEquals(1, Modpack::count());

        $response = $this->delete('/modpacks/brothers-klaus');

        $response->assertRedirect('/login');
        $this->assertEquals(1, Modpack::count());
    }

    /** @test */
    public function cannot_delete_a_nonexistant_modpack()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete('/modpacks/not-a-modpack-slug');

        $response->assertStatus(404);
    }
}
