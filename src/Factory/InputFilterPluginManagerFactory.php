<?php
/**
 * @see https://github.com/dotkernel/dot-inputfilter/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-inputfilter/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\InputFilter\Factory;

use Psr\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;

/**
 * Class InputFilterPluginManagerFactory
 * @package Dot\InputFilter\Factory
 */
class InputFilterPluginManagerFactory
{
    protected $configKey = 'dot_input_filter';
    protected $inputFilterManagerConfigKey = 'input_filter_manager';

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config') ? $container->get('config') : [];
        if (isset($config[$this->configKey])
            && isset($config[$this->configKey][$this->inputFilterManagerConfigKey])
            && is_array($config[$this->configKey][$this->inputFilterManagerConfigKey])
        ) {
            $config = $config[$this->configKey][$this->inputFilterManagerConfigKey];
        }

        return new InputFilterPluginManager($container, $config);
    }
}
