<?php
/**
 * @copyright: DotKernel
 * @library: dot-inputfilter
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:50 PM
 */

namespace Dot\InputFilter;

use Dot\InputFilter\Factory\InputFilterAbstractServiceFactory;
use Dot\InputFilter\Factory\InputFilterPluginManagerFactory;
use Zend\InputFilter\InputFilterPluginManager;

/**
 * Class ConfigProvider
 * @package Dot\InputFilter
 */
class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependenciesConfig(),

            'dot_input_filter' => [

                'input_filter_manager' => [],

                'input_filters' => [],
            ],
        ];
    }

    public function getDependenciesConfig()
    {
        return [
            'abstract_factories' => [
                InputFilterAbstractServiceFactory::class,
            ],
            'factories' => [
                'InputFilterManager' => InputFilterPluginManagerFactory::class,
            ],
            'aliases' => [
                InputFilterPluginManager::class => 'InputFilterManager',
            ],
        ];
    }
}
