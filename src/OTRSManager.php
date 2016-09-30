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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * Description of OTRSManager
 *
 * @author ilgala
 */
class OTRSManager extends AbstractManager
{

    /**
     * The factory instance.
     *
     * @var \IlGala\LaravelOTRS\OTRSFactory
     */
    protected $factory;

    /**
     * Create a new OTRS manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository          $config
     * @param \lGala\LaravelOTRS\OTRSFactory                   $factory
     *
     * @return void
     */
    public function __construct(Repository $config, OTRSFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \IlGala\LaravelOTRS\GenericInterface
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'otrs';
    }

    /**
     * Get the factory instance.
     *
     * @return \lGala\LaravelOTRS\OTRSFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

}
