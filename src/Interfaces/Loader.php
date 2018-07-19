<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 18:36
 */

namespace Xydens\Configuration\Interfaces;

/**
 * Interface Loader
 *
 * Loaders are used to convert configuration data from
 * different formats to normalized configuration type -
 * array
 *
 * In addition, loaders can perform other functions like
 * validation
 *
 * @package Xydens\Configutetion\Interfaces
 */
interface Loader {

    /**
     * Returns associative configuration array
     * @return array
     */
    public function getConfigurationArray();

    /**
     * Loads configuration content and converts it to array
     * @return void
     */
    public function load();

}