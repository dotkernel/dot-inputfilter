<?php
/**
 * @copyright: DotKernel
 * @library: dot-inputfilter
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:53 PM
 */

namespace Dot\InputFilter\Factory;

use Interop\Container\ContainerInterface;
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
            && is_array($config[$this->configKey][$this->inputFilterManagerConfigKey])) {
            $config = $config[$this->configKey][$this->inputFilterManagerConfigKey];
        }

        return new InputFilterPluginManager($container, $config);
    }
}
