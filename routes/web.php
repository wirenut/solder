<?php

/*
 * This file is part of TechnicPack Solder.
 *
 * (c) Syndicate LLC
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::view('/login', 'auth.login')->name('auth.show-login');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController');

    Route::get('forge', 'ForgeController@getMCVersions');
    Route::get('forge/{mcversion}', 'ForgeController@getForgeVersions');

    Route::get('/modpacks/{modpack}', 'ModpacksController@show');
    Route::post('/modpacks', 'ModpacksController@store');
    Route::patch('/modpacks/{modpack}', 'ModpacksController@update');
    Route::delete('/modpacks/{modpack}', 'ModpacksController@destroy');

    Route::post('/modpacks/{modpack}/collaborators', 'ModpackCollaboratorsController@store');

    Route::delete('/collaborators/{collaborator}', 'CollaboratorsController@destroy');

    Route::get('/modpacks/{modpack}/{build}', 'ModpackBuildsController@show');
    Route::post('/modpacks/{modpack}/builds', 'ModpackBuildsController@store');
    Route::post('/modpacks/{modpack}/{build}', 'ModpackBuildsController@update');
    Route::delete('/modpacks/{modpack}/{build}', 'ModpackBuildsController@destroy');

    Route::get('/library', 'PackagesController@index');
    Route::get('/library/{package}', 'PackagesController@show');
    Route::post('/library', 'PackagesController@store');
    Route::patch('/library/{package}', 'PackagesController@update');
    Route::delete('/library/{package}', 'PackagesController@destroy');

    Route::post('/library/{package}/releases', 'PackageReleasesController@store');

    Route::delete('/releases/{release}', 'ReleasesController@destroy');

    Route::delete('/bundles', 'BundlesController@destroy');
    Route::post('/bundles', 'BundlesController@store');
});

Route::middleware('auth')->namespace('Admin')->prefix('settings')->group(function () {
    Route::view('about', 'settings.about');

    Route::view('api', 'settings.api');

    Route::get('permissions', 'PermissionsController@index');
    Route::post('permissions', 'PermissionsController@update');

    Route::view('clients', 'settings.clients');
    Route::view('keys', 'settings.keys');
    Route::view('manage-teams', 'settings.teams');

    Route::get('users', 'UsersController@index');
    Route::post('users', 'UsersController@store');
    Route::post('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('settings/teams', 'Settings\TeamsController@index');
    Route::post('settings/teams', 'Settings\TeamsController@store');
    Route::delete('settings/teams/{team}', 'Settings\TeamsController@destroy');
    Route::patch('settings/teams/{team}/name', 'Settings\TeamNameController@update');
});
