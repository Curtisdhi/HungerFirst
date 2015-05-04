<?php

namespace HungerFirst\HFBundle\Form\Model;

use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Assert\Callback(methods={"matchKey"})
 */
class AdminOverrideModel {
    
    /**
     * Admin key
     * @Assert\NotBlank()
     * 
     * @var string
     */
    private $key;
    
    /**
     * Route to controller to requested override
     * 
     * @var string
     */
    private $route;
    
    /**
     * Route parameters
     * 
     * @var array
     */
    private $parameters;
    
    /**
     * get admin key
     * 
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * Set admin key
     * @param string $key
     * @return AdminOverrideModel
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }
    
    /**
     * Get route
     * 
     * @return string
     */
    public function getRoute() {
        return $this->route;
    }
    
    /**
     * Set route
     * 
     * @param string $route
     * @return AdminOverrideModel
     */
    public function setRoute($route) {
        $this->route = $route;
        return $this;
    }
    
    /**
     * Get route parameters
     * 
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * Set route parameters
     * 
     * @param array $parameters
     * @return AdminOverrideModel
     */
    public function setParameters($parameters) {
        $this->parameters = $parameters;
        return $this;
    }
    
    /**
     * Hack way to match keys to the ones in parameters
     * 
     * @global AppKernel $kernel
     */
    public function matchKey(ExecutionContextInterface $context) { 
        global $kernel;
        if ('AppCache' == get_class($kernel)) {
            $kernel = $kernel->getKernel();
        }
        $override = $kernel->getContainer()->get('admin_override_service')->canOverride($this->key);
        if (!$override) {
            $context->addViolationAt('key', 'Key doesn\'t match', array(), null);
        }

    }

}
