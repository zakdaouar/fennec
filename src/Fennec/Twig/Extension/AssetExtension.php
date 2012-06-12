<?php

namespace Fennec\Twig\Extension;

use Fennec\Application;

class AssetExtension extends \Twig_Extension 
{
    protected $app;

    function __construct(Application $app)
    {
        $this->app = $app;
    }


    public function getFunctions()
    {
        return array('asset' => new \Twig_Function_Method($this, 'asset'));
    }

    public function asset($url) 
    {
        return $this->app['request']->getBasePath().$url;
    }

    public function getName()
    {
        return 'fennec_asset';
    }
}