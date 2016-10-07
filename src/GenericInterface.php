<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelOTRS;

/**
 *
 * @author ilgala
 */
interface GenericInterface
{

    /**
     * Returns the interface layer of OTRS framework
     *
     * @return string
     */
    public function getInterface();

    /**
     * Returns the webservice name
     *
     * @return string
     */
    public function getWebservice();

    /**
     * Returns the OTRS user username (admin or client)
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get the the OTRS user password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Call the selected operation of the REST webservice. The client param determine if the login username param will be "UserLogin" or "CustomerUserLogin"
     *
     * @param type $operation
     * @param type $data
     * @param boolean client
     */
    public function callOperation($operation, $data, $client);
}
