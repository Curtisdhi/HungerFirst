<?php

namespace HungerFirst\HFBundle\Service;

class AdminOverrideService
{
    private $overrideKeys;
    
    public function __construct($overrideKeys) {
        $this->overrideKeys = $overrideKeys;
    }
    
    public function canOverride($key) {
        return in_array($key, $this->overrideKeys);
    }
}
