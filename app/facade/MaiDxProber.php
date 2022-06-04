<?php

namespace app\facade;

use think\Facade;

class MaiDxProber extends Facade
{
    protected static function getFacadeClass(): string
    {
        return 'app\facade\MaiDxProberFacade';
    }
}
