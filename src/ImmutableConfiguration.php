<?php

/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 15:40
 */

namespace Xydens\Configuration;

use Xydens\Configuration\Interfaces\Configuration;

class ImmutableConfiguration extends AbstractConfiguration implements Configuration {

    /**
     * {@inheritdoc}
     * Returns new mutated instance
     */
    public function set($key, $value) {
        $wrapped_key = self::wrapKey($key);
        $instance = clone $this;
        $instance->mutate($wrapped_key,$value);
        return $instance;
    }

    public function merge(Configuration $configuration) {
        $instance = clone $this;
        $instance->mergeWithMutation($configuration);
        return $instance;
    }

}