<?php

namespace Fennec;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    
    private $routes;

    /**
     * the router construct takes a yaml config file
     * @param string $config_file routes config file path
     */
    public function __construct($config_file) 
    {
        if (!file_exists($config_file)) {
            throw new \Exception('the routing config file was not found');
        }

        $this->routes = Yaml::parse($config_file);
    }

    /**
     * Load the routes defined in the config file into the fennec application
     * @param  Application $app Fennec application
     */
    public function load(Application $app)
    {
        foreach ($this->routes as $key => $route) {
            $type = $route['type'];
            $route_conf = $app->$type($route['pattern'], function(Request $request) use ($route, $app) {

                // Resolving the controler
                $controler_classname = sprintf('\Fennec\Controler\%sControler', ucfirst($route['controler']));
                if (!class_exists($controler_classname)) {
                    throw new \Exception(sprintf('The controler %s was not found', $route['controler']));
                }
                $controler = new $controler_classname($app);

                // Resolving the action
                $method_name = sprintf('%sAction', $route['action']);
                if (!method_exists($controler, $method_name)) {
                    throw new \Exception(sprintf('The action %s was not found in the controler %s', $route['action'], $route['controler']));
                }

                // Launch the action
                return call_user_func_array(array($controler, $method_name), $request->get('_route_params'));
            })->bind($key);

            $requirements = isset($route['requirements']) ? $route['requirements'] : array();
            foreach ($requirements as $key => $regex) {
                $route_conf->assert($key, $regex);
            }
        }
    }
}