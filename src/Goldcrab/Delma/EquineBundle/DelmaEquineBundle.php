<?php

namespace Goldcrab\Delma\EquineBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DelmaEquineBundle extends Bundle
{

    public function boot(){
        //print "<h1>I was called here</h1>" . $this->container->getParameter('delma_equine.cache_dir');
    }

}
