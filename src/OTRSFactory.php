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

use IlGala\LaravelOTRS\OTRSGenericInterface;
use IlGala\LaravelOTRS\Adapters\ConnectionFactory as AdapterFactory;

/**
 * This is the OTRS factory class.
 *
 * @author ilgala
 */
class OTRSFactory
{

    /**
     * The adapter factory instance.
     *
     * @var \IlGala\LaravelOTRS\Adapters\ConnectionFactory
     */
    protected $adapter;

    /**
     * Create a new filesystem factory instance.
     *
     * @param \IlGala\LaravelOTRS\Adapters\ConnectionFactory $adapter
     *
     * @return void
     */
    public function __construct(AdapterFactory $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Make a new digitalocean client.
     *
     * @param string[] $config
     *
     * @return \IlGala\LaravelOTRS\OTRSGenericInterface
     */
    public function make(array $config)
    {
        $adapter = $this->createAdapter($config);
        return new OTRSGenericInterface($adapter, $config);
    }

    /**
     * Establish an adapter connection.
     *
     * @param array $config
     *
     * @return \IlGala\LaravelOTRS\Wrappers\WrapperInterface
     */
    public function createAdapter(array $config)
    {
        return $this->adapter->make($config);
    }

    /**
     * Get the adapter factory instance.
     *
     * @return \IlGala\LaravelOTRS\Adapters\ConnectionFactory
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

}
