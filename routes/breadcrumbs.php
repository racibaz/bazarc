<?php
/**
 * Created by PhpStorm.
 * User: muhammed.cansiz
 * Date: 14-May-19
 * Time: 3:58 PM.
 */

// Dashboard
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

//region Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});
//endregion

//region Profile Breadcrumb
Breadcrumbs::for('profile.show', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile Show', route('profile.show', auth()->user()->getAuthIdentifier()));
});

Breadcrumbs::for('profile.edit', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile Edit', route('profile.edit', auth()->user()->getAuthIdentifier()));
});
//endregion

//region   models of resource routes macro breadcrumbs
Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('New', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
        $trail->parent("$name.index");
        $trail->push('Show Page', route("$name.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Edit', route("$name.edit", $model));
    });
});

Breadcrumbs::resource('user', 'Users');
Breadcrumbs::resource('setting', 'Settings');
Breadcrumbs::resource('activity_log', 'Activity Log');
Breadcrumbs::resource('role', 'Roles');
Breadcrumbs::resource('permission', 'Permission');
//endregion
