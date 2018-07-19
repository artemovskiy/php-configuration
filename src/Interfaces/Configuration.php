<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 19:49
 */

namespace Xydens\Configuration\Interfaces;


interface Configuration {

    /**
     * Returns value by key from config
     * If value does not exists, returns $default
     * Uses JS styled key format, for example:
     * Config array: [
     *      'web' => [
     *          'domain' => 'localhost',
     *          'port' => 80
     *      ]
     * ]
     *
     * $config->get('web.domain');
     * #returns localhost
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key,$default = null);

    /**
     * Checks if this configuration has $key
     * Uses JS styled key format, for example:
     * Config array: [
     *      'web' => [
     *          'domain' => 'localhost',
     *          'port' => 80
     *      ]
     * ]
     *
     * $config->has('web.domain');
     * #returns true
     *
     * $config->has('web.path');
     * #returns false
     *
     * @param string $key
     * @return boolean
     */
    public function has($key);

    /**
     * Returns value by key from config
     * If value does not exists, throws an exception
     * Uses JS styled key format, for example:
     * Config array: [
     *      'web' => [
     *          'domain' => 'localhost',
     *          'port' => 80
     *      ]
     * ]
     *
     * $config->get('web.domain');
     * #returns localhost
     *
     * @param string $key
     * @return mixed
     */
    public function getOrFail($key);

    /**
     * Sets $value for given $key
     * Uses JS styled key format, for example:
     * Config array: [
     *      'web' => [
     *          'domain' => 'localhost',
     *          'port' => 80
     *      ]
     * ]
     *
     * $config->set('web.path','/blog');
     * $config->get('web.path');
     * #returns /blog
     *
     * @param string $key
     * @param mixed $value
     * @return Configuration
     */
    public function set($key,$value);

    /**
     * Merges configurations to one
     *
     * @param Configuration $configuration
     * @return Configuration
     */
    public function merge(Configuration $configuration);

    /**
     * Returns config array
     * @return array
     */
    public function toArray();

}