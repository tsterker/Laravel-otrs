<?php

/*
 * This file is part of the Laravel OTRS library.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelOTRS\Wrappers;

/**
 * This is the generic wrapper interface.
 *
 * @author ilgala
 */
interface WrapperInterface
{

    /**
     * @param string $url
     *
     * @throws HttpException
     *
     * @return string
     */
    public function get($url, $content = '');

    /**
     * @param string $url
     *
     * @throws HttpException
     */
    public function delete($url, $content = '');

    /**
     * @param string       $url
     * @param array|string $content
     *
     * @throws HttpException
     *
     * @return string
     */
    public function put($url, $content = '');

    /**
     * @param string       $url
     * @param array|string $content
     *
     * @throws HttpException
     *
     * @return string
     */
    public function post($url, $content = '');

    /**
     * @return array|null
     */
    public function getLatestResponseHeaders();
}
