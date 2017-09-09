<?php

/*
 * This file is part of Solder.
 *
 * (c) Kyle Klaus <kklaus@indemnity83.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit;

use App\Modpack;
use Tests\TestCase;
use Illuminate\Support\Optional;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModpackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function promoted_build_attribute_is_optional()
    {
        $modpack = factory(Modpack::class)->make([
            'promoted_build_id' => null,
        ]);

        $this->assertInstanceOf(Optional::class, $modpack->promoted_build);
    }

    /** @test */
    public function latest_build_attribute_is_optional()
    {
        $modpack = factory(Modpack::class)->make([
            'latest_build_id' => null,
        ]);

        $this->assertInstanceOf(Optional::class, $modpack->latest_build);
    }
}
