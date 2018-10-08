<?php

namespace BoutiqueBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BoutiqueBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
