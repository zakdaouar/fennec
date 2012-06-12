<?php

namespace Fennec\Controler;

class ApiControler extends Controler
{
    public function testAction()
    {
        return $this->renderJSON(array('result' => 'ok'));
    }
}