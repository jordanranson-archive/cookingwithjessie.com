<?php

chdir('.');
include_once 'epi/Epi.php';
Epi::setPath('base', './epi');
Epi::setPath('view', '');
Epi::init('api','route','template');


/*
 * We create 3 normal routes (think of these are user viewable pages).
 * We also create 2 api routes (this of these as data methods).
 *  The beauty of the api routes are they can be accessed natively from PHP
 *    or remotely via HTTP.
 *  When accessed over HTTP the response is json.
 *  When accessed natively it's a php array/string/boolean/etc.
 */
getRoute()->get('/', 'home');
getRoute()->get('/recipe/(\d+)', 'recipe');
getRoute()->run();

/*
 * ******************************************************************************************
 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
 * ******************************************************************************************
 */

// routes

function home() {
    $template = new EpiTemplate();

    $params = array();
    $params['id'] = 1;

    $template->display('recipe.php', $params);
}

function recipe( $id ) {
    $template = new EpiTemplate();

    $params = array();
    $params['id'] = $id;

    $template->display('recipe.php', $params);
}