<?php

namespace HungerFirst\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HFUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
