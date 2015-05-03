<?php

namespace HungerFirst\HFBundle\Service;

class ProbationService
{
    public function hasProbation($customer) {
        $date = new \DateTime();
        $delta = 0;
        if ($customer->getProbationEndDate()) {
            $delta = $customer->getProbationEndDate()->getTimestamp() - $date->getTimestamp();
        }
        return $delta > 0;
    }
}
