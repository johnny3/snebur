<?php

namespace LFSM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LFSMUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
