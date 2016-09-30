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

use InvalidArgumentException;

/**
 * This is the OTRS Wrapper for the generic interface
 *
 * @author ilgala
 */
class OTRSGenericInterface implements GenericInterface
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $otrs_interface = 'nph-genericinterface.pl';

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $webservice;

    /**
     * @var array
     */
    protected $operations = [];

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter, $config)
    {
        if (!array_key_exists('username', $config)) {
            throw new InvalidArgumentException('the option "username" is mandatory');
        }

        if (!array_key_exists('password', $config)) {
            throw new InvalidArgumentException('the option "password" is mandatory');
        }

        if (!array_key_exists('webservice', $config)) {
            throw new InvalidArgumentException('the option "webservice" is mandatory');
        }

        if (!array_key_exists('url', $config)) {
            throw new InvalidArgumentException('the option "url" is mandatory');
        }

        $this->adapter = $adapter;
        $this->url = $config['url'] . '/' . $this->otrs_interface . '/Webservice/' . $this->webservice;
        $this->operations = $config['operations'];
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getInterface()
    {
        return $this->otrs_interface;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getWebservice()
    {
        return $this->webservice;
    }

    public function callOperation($operation, $data, $client)
    {
        if (!array_key_exists($operation, $this->operations)) {
            throw new InvalidArgumentException('Cannot find the method {$method}');
        }

        $login = $client ? 'CustomerUserLogin' : 'UserLogin';

        $formatted_data = array_merge($data, [$login => $this->username, 'Password' => $this->password]);

        $callback = $this->operations[$operation];

        return $this->adapter->$callback['method'](sprintf('%s/' . $callback['route'], $this->url), $formatted_data);
    }

}
