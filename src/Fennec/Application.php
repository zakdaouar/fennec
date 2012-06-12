<?php

namespace Fennec;

use Silex\Application as BaseApplication;
use Fennec\Twig\Extension\AssetExtension;

class Application extends BaseApplication
{
    
    public function __construct() 
    {
        parent::__construct();

        // Loading the routes
        $router = new Router(__DIR__.'/../../config/routing.yml');
        $router->load($this);

        // Bootstraping Twig
        $this->register(new \Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/Views',
        ));
        $this['twig']->addExtension(new AssetExtension($this));
        $this['debug'] = true;
    }

}