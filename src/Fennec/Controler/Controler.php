<?php

namespace Fennec\Controler;

use Fennec\Application;
use Symfony\Component\HttpFoundation\Response;

abstract class Controler 
{
    /**
     * The fennec app
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app the fennec app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * render a twig template
     * @param  string $template
     * @param  mixed[] $parameters
     * @return string
     */
    protected function render($template, $parameters = array())
    {
        return $this->app['twig']->render($template, $parameters);
    }

    protected function renderJSON($array)
    {
        return new Response(json_encode($array), 200, array(
            'Content-Type' => 'application/json'
        ));
    }
}