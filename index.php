<?php
/**
 * Main entry point for the application.
 *
 * This file includes the necessary dependencies and configurations required
 * for the application to run. It sets up the session, loads configuration
 * settings, initializes the database connection, and includes various helper
 * functions and classes.
 *
 * Included files:
 * - session.php: Manages user sessions.
 * - config.php: Contains configuration settings.
 * - database.php: Sets up the database connection.
 * - autoloader.php: Autoloads necessary classes.
 * - functions.php: Contains general helper functions.
 * - helpers.php: Contains additional helper functions.
 * - classes.php: Includes class definitions.
 */
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/autoloader.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/classes.php';

/**
 * Main entry point for the web application.
 * 
 * This file includes the necessary routes for the application to function.
 * 
 * @file /C:/Users/Admin/Desktop/WEBServer/inna_dekoverleih_com/index.php
 * @requires /includes/routes.php
 */
require __DIR__ . '/includes/routes.php';
require __DIR__ . '/includes/ajax.php';

// Client Log
$clientController->logClient();
$clientController->onlineClients();

// TODO: Remove online client -> to cronjob
$clientController->deleteOnlineClient();

/**
 * Page not found handler
 */
$router->setNotFoundHandler(function () use ($metaController) {
    http_response_code(404);
    renderPage('error', '404');
    global $urlLink;
    $metaController->logError('Page not found: ' . $urlLink, 'error');
});

/**
 * Dispatches the current request to the appropriate route.
 * 
 * This method is responsible for handling the incoming request and
 * routing it to the correct controller and action based on the defined
 * routes. It processes the request and generates the appropriate response.
 * 
 * @return void
 */
$router->dispatch();
