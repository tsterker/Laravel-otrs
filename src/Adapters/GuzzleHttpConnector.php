<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelOTRS\Adapters;

use IlGala\LaravelOTRS\Wrappers\GuzzleHttpWrapper;
use GrahamCampbell\Manager\ConnectorInterface;
use InvalidArgumentException;

/**
 * This is the guzzlehttp connector class.
 *
 * @author ilgala
 */
class GuzzleHttpConnector implements ConnectorInterface
{

    /**
     * Establish an adapter connection.
     *
     * @param string[] $config
     *
     * @return \IlGala\LaravelOTRS\Wrappers\GuzzleHttpWrapper
     */
    public function connect(array $config)
    {
        $config = $this->getConfig($config);
        return $this->getAdapter($config);
    }

    /**
     * Get the configuration.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        return $config;
    }

    /**
     * Get the guzzlehttp adapter.
     *
     * @param string[] $config
     *
     * @return \IlGala\LaravelOTRS\Wrappers\GuzzleHttpWrapper
     */
    protected function getAdapter(array $config)
    {
        return new GuzzleHttpWrapper($config);
    }

}
