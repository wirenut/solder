<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ForgeController extends Controller
{
    public function getMcVersions()
    {
        $forge_xml = simplexml_load_file('http://files.minecraftforge.net/maven/net/minecraftforge/forge/maven-metadata.xml');
        $forge_json = json_decode(json_encode($forge_xml));

        $forge_versions = $forge_json->versioning->versions->version;
        $forge_version_list = [];
        foreach ($forge_versions as $version) {
            $explode = explode('-', $version, 2);
            $forge_version_list[$explode[0]][] = $explode[1];
        }
        $mcversions = [];
        foreach ($forge_version_list as $mc => $forge) {
            $mcversions[] = $mc;
        }
        $mcversions = array_reverse($mcversions);

        return response()->json($mcversions);
    }

    public function getForgeVersions($mcversion)
    {
        $forge_xml = simplexml_load_file('http://files.minecraftforge.net/maven/net/minecraftforge/forge/maven-metadata.xml');
        $forge_json = json_decode(json_encode($forge_xml));

        $forge_versions = $forge_json->versioning->versions->version;
        $forge_version_list = [];
        foreach ($forge_versions as $version) {
            $explode = explode('-', $version, 2);
            $forge_version_list[$explode[0]][] = $explode[1];
        }
        $forge_version_list = array_reverse($forge_version_list[$mcversion]);

        return response()->json($forge_version_list);
    }
}
