<?php
/**
 * Created by PhpStorm.
 * User: muhammed.cansiz
 * Date: 14-May-19
 * Time: 3:58 PM
 */

// Dashboard
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('backend.dashboard'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('backend.users'));
});

//// Home
//Breadcrumbs::for('home', function ($trail) {
//    $trail->push('Home', route('home'));
//});
//
//// Home > About
//Breadcrumbs::for('about', function ($trail) {
//    $trail->parent('home');
//    $trail->push('About', route('about'));
//});
//
//// Home > Blog
//Breadcrumbs::for('blog', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function ($trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
//});