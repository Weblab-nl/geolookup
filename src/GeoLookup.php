<?php
// add the namespace
namespace Weblab;

/**
 * Class that gives access to the google maps api
 * 
 * @author  Weblab.nl - Thomas Marinissen
 */
class GeoLookup {
    
    /**
     * The google maps api base url
     */
    const BASE_URL = 'http://maps.google.com/maps/api/geocode/json';

    /**
     * Singleton instance
     *
     * @var \Weblab\GeoLookup
     */
    private static $instance = null;
    
    /**
     * The constructor made private
     */
    private function __construct() { }

    /**
     * Singleton access the \Weblab\GeoLookup class
     * 
     * @return \Weblab\GeoLookup
     */
    public static function instance() {
        // if the instance of the google maps class has been created already,
        // return the instance
        if (!is_null(self::$instance)) {
            return self::$instance;
        }
        
        // create a new instance of the google maps class and return it
        return self::$instance = new \Weblab\GeoLookup();
    }
    
    
    /**
     * Request the google maps result object based on an address
     * 
     * @param   string                                          The address
     * @return  \Weblab\GoogleMapsResult              The google maps api result object
     */
    public static function requestByAddress($address, $language = 'nl') {
        // the parameters needed to get the google maps address information
        $parameters = array(
            'address'   => $address,
            'sensor'    => 'false',
            'language'  => $language
        );
 
        // create a google maps object to get access to the google maps api
        $googleMaps = self::instance();
        
        // get the values from google maps
        $geocode = $googleMaps->curl($parameters);

        // if there is no valid result, return null
        if ($geocode === false) {
            return null;
        }
        
        // done, return the google maps 
        return new \Weblab\GoogleMapsResult($geocode);
    }
    
    /**
     * Helper method that requests a result according to a given url from the
     * google maps api
     * 
     * @param   array           The parameters to add to the url
     * @return  string          The response of the google maps api
     */
    protected function curl($parameters) {
        // create the url
        $url = self::BASE_URL . '?' . http_build_query($parameters);
        
        // prepare everything for the curl request at the google server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        // execute the curl request
        $response = curl_exec($ch);
        
        // close the curl request
        curl_close($ch);
        
        // done, return the response
        return $response;
    }
    
}
