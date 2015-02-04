<?php

namespace CCM\LocatorBundle\Locator;

class GooglePlaceLocator implements LocatorInterface
{
    private $key;

    /**
     * @param string $key The Google API key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function searchByKeyword($query)
    {
        $urlEncodedQuery = urlencode($query);

        $url = sprintf('https://maps.googleapis.com/maps/api/place/textsearch/json?query=%s&key=%s', $urlEncodedQuery, $this->key);

        $result = json_decode(file_get_contents($url), true);

        return array_map(function($result) {
            return [
                'name' => $result['name'],
                'address' => $result['formatted_address'],
                'source' => 'Google',
            ];

        }, $result['results']);
    }
}
