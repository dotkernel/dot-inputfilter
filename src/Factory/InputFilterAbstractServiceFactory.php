<?php
/**
 * @see https://github.com/dotkernel/dot-inputfilter/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-inputfilter/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\InputFilter\Factory;

use Interop\Container\ContainerInterface;

/**
 * Class InputFilterAbstractServiceFactory
 * @package Dot\InputFilter\Factory
 */
class InputFilterAbstractServiceFactory extends \Zend\InputFilter\InputFilterAbstractServiceFactory
{
    const PREFIX = 'dot-input-filter';

    /** @var string */
    protected $configKey = 'dot_input_filter';

    /** @var string */
    protected $subConfigKey = 'input_filters';

    /**
     * @param ContainerInterface $services
     * @param string $rName
     * @return bool
     */
    public function canCreate(ContainerInterface $services, $rName)
    {
        $parts = explode('.', $rName);
        if (count($parts) !== 2) {
            return false;
        }
        if ($parts[0] !== static::PREFIX) {
            return false;
        }

        if (!$services->has('config')) {
            return false;
        }
        $config = $services->get('config');

        if (!isset($config[$this->configKey])) {
            return false;
        }

        if (!isset($config[$this->configKey][$this->subConfigKey])
            || !is_array($config[$this->configKey][$this->subConfigKey])
        ) {
            return false;
        }

        return array_key_exists($rName, $config[$this->configKey][$this->subConfigKey]);
    }

    /**
     * @param ContainerInterface $services
     * @param string $rName
     * @param array|null $options
     * @return \Zend\InputFilter\InputFilterInterface
     */
    public function __invoke(ContainerInterface $services, $rName, array $options = null)
    {
        $config = $services->get('config');
        $parts = explode('.', $rName);
        $config = $config[$this->configKey][$this->subConfigKey][$parts[1]];
        $factory = $this->getInputFilterFactory($services);

        return $factory->createInputFilter($config);
    }
}
