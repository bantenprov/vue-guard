<?php namespace Bantenprov\VueGuard\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The VueGuard facade.
 *
 * @package Bantenprov\VueGuard
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueGuard extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vue-guard';
    }
}
