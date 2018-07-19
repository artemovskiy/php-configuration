<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 19:01
 */

namespace Xydens\Configuration\Interfaces;


interface Middleware {

    /**
     * @param $configuration_array
     * @return array
     */
    public function run($configuration_array);

}