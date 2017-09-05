<?php

class AppFactory
{
    public static $instance;

    public static function create($config)
    {
        // Prepare app
        $app = new \Framework\App($config['frameworkOptions']);
        $app->config = $config;

        // Define routes
        $blog = new \Controller\Blog($app);

        $app->get('/', [$blog, 'index']);
        $app->get('/post/:id', [$blog, 'show']);
        $app->get('/post/:id/edit', [$blog, 'edit']);
        $app->post('/post/:id/edit', [$blog, 'postEdit']);


        return self::$instance = $app;
    }
}
