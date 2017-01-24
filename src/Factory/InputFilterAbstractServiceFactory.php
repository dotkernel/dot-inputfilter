<?php
/**
 * @copyright: DotKernel
 * @library: dot-inputfilter
 * @author: n3vrax
 * Date: 1/24/2017
 * Time: 11:59 PM
 */

namespace Dot\InputFilter\Factory;

use Interop\Container\ContainerInterface;

/**
 * Class InputFilterAbstractServiceFactory
 * @package Dot\InputFilter\Factory
 */
class InputFilterAbstractServiceFactory extends \Zend\InputFilter\InputFilterAbstractServiceFactory
{
    /** @var string  */
    protected $configKey = 'dot_input_filter';

    /** @var string  */
    protected $subConfigKey = 'input_filters';

    /**
     * @param ContainerInterface $services
     * @param string $rName
     * @return bool
     */
    public function canCreate(ContainerInterface $services, $rName)
    {
        if (! $services->has('config')) {
            return false;
        }
        $config = $services->get('config');

        if (! isset($config[$this->configKey])) {
            return false;
        }

        if (! isset($config[$this->configKey][$this->subConfigKey])
            || ! is_array($config[$this->configKey][$this->subConfigKey])) {
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
        $config = $config[$this->configKey][$this->subConfigKey][$rName];
        $factory = $this->getInputFilterFactory($services);

        return $factory->createInputFilter($config);
    }
}
