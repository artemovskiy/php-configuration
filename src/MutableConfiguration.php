<?php

/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 20:01
 */

namespace Xydens\Configuration;

use Xydens\Configuration\Interfaces\Configuration;

class MutableConfiguration extends AbstractConfiguration implements Configuration {

    /**
     * {@inheritdoc}
     * Return old mutated instance
     */
    public function set($key, $value) {
        $wrapped_key = self::wrapKey($key);
        $this->mutate($wrapped_key,$value);
        return $this;
    }

    public function merge(Configuration $configuration) {
        $instance = $this;
        $instance->mergeWithMutation($configuration);
        return $instance;
    }

}