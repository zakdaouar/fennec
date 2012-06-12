<?php

namespace Fennec\Controler;

class MainControler extends Controler
{
    public function indexAction()
    {
        return $this->render('layout.html.twig');
    }
}