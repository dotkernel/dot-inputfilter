<?php
/**
 * @see https://github.com/dotkernel/dot-inputfilter/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-inputfilter/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\InputFilter;

use Dot\InputFilter\Factory\InputFilterAbstractServiceFactory;
use Dot\InputFilter\Factory\InputFilterPluginManagerFactory;
use Laminas\InputFilter\InputFilterPluginManager;

/**
 * Class ConfigProvider
 * @package Dot\InputFilter
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependenciesConfig(),

            'dot_input_filter' => [

                'input_filter_manager' => [],

                'input_filters' => [],
            ],
        ];
    }

    public function getDependenciesConfig(): array
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
