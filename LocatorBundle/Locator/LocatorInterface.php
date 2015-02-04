<?php

namespace CCM\LocatorBundle\Locator;


/**
 * Interface to implement to locate places.
 *
 * @package CCM\LocatorBundle\Locator
 */
interface LocatorInterface
{
    /**
     * @param string $query
     *
     * @return array
     */
    public function searchByKeyword($query);
} 
