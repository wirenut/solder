<?php

/*
 * This file is part of TechnicPack Solder.
 *
 * (c) Syndicate LLC
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

class StorageController extends Controller
{
    public function getModFile($slug, $file_name)
    {
        $path = storage_path('app/public/modpack/'.$slug.'/'.$file_name);

        return response()->download($path);
    }
}