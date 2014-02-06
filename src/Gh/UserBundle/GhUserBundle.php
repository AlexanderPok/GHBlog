<?php

namespace Gh\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GhUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
