<?php

namespace Goldcrab\Delma\EquineBundle\Twig;

class DelmaTwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('pageNo', array($this, 'pageNo')),
        );
    }

    public function pageNo()
    {
        static $pageNo = 0;
        $pageNo++;
        return $pageNo;
    }

    public function getName()
    {
        return 'delma_extension';
    }
}