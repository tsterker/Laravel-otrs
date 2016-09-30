<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelOTRS\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * This is the OTRSGenericInterface facade class
 *
 * @author ilgala
 */
class OTRSGenericInterface extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'otrs';
    }

}
