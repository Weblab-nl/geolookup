<?php
namespace Weblab\GeoLookup;

/**
 * Class holding a result returned by the google maps api
 * 
 * @author  Weblab.nl - Thomas Marinissen
 */
class GoogleMapsResult {
    
    /**
     * The original given result as strong
     * 
     * @var string
     */
    protected $originalResult;
    
    /**
     * The json decoded result as it came from google maps
     * 
     * @var \stdClass
     */
    protected $result;
    
    /**
     * Constructor
     * 
     * @param string            The result as it came as strong from the google maps api
     */
    public function __construct($result) {
        $this->originalResult = $result;
        $this->result = json_decode($result);
    }
    
    /**
     * Get the latitude of the result set
     * 
     * @return float
     */
    public function latitude() {
        // if there is no latitdude, return null
        if (!isset($this->result->results[0]->geometry->location->lat)) {
            return null;
        }
        
        // done, return the latitdude
        return $this->result->results[0]->geometry->location->lat;
    }
    
    /**
     * Get the longitude of the result set
     * 
     * @return float
     */
    public function longitude() {
        // if there is no longitude, return null
        if (!isset($this->result->results[0]->geometry->location->lng)) {
            return null;
        }
        
        // done, return the longitude
        return $this->result->results[0]->geometry->location->lng;
    }
    
    /**
     * Get the geo coordinates for the google maps result
     * 
     * @return \Weblab\GeoLookup\GeoCoordinates         The latitude and longitude wrapped into a GeoCoordinates object
     */
    public function geoCoordinates() {
        // get the latitude
        $latitude = $this->latitude();
        
        // get the longitude
        $longitude = $this->longitude();
        
        // if either the latitude or the longitude is not set, return null
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }
        
        // return the geo coordinates
        return new \Weblab\GeoLookup\GeoCoordinates($latitude, $longitude);
    }
}