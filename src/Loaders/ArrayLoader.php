<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 19:08
 */

namespace Xydens\Configuration\Loaders;


use Xydens\Configuration\Interfaces\Loader;

/**
 * Class ArrayLoader
 *
 * The simplest configuration loader
 *
 *
 * @package Xydens\Configuration\Loaders
 */

class ArrayLoader extends BasicLoaderWithMiddlewares implements Loader {

    /**
     * ArrayLoader constructor.
     * @param $array
     */
    function __construct($array) {
        $this->setContent($array);
    }

}