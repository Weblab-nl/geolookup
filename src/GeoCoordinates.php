<?php
namespace Weblab\GeoLookup;

/**
 * Class holding a pair of geo coordinates marking a point on the map
 * 
 * @author  Weblab.nl - Thomas Marinissen
 */
class GeoCoordinates {
    
    /**
     * The latitude of the geo coordinate
     * 
     * @var float
     */
    private $latitude;
    
    /**
     * The longitude of the geo coordinate
     * 
     * @var float
     */
    private $longitude;
    
    /**
     * Constructor
     * 
     * @param float           The latitude
     * @param float           The longitude
     */
    public function __construct($latitude, $longitude) {
        // set the longitude and latitude
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
    
    /**
     * Return the latitude
     * 
     * @return float           The latitude
     */
    public function latitude() {
        return $this->latitude;
    }
    
    /**
     * Return the longitude
     * 
     * @return float           The longitude
     */
    public function longitude() {
        return $this->longitude;
    }
    
    /**
     * Set the latitudue
     * 
     * @param   float                                               The latitude to set
     * @return  \Weblab\GeoLookup\GeoCoordinates                    Instance of this to make chaining possible
     */
    public function setLatitude($latitude) {
        // set the latitude
        $this->latitude = $latitude;
        
        // return the instance of this to make chaining possible
        return $this;
    }
    
    /**
     * Set the longitude
     * 
     * @param   float                                               The longitude to set
     * @return  \Weblab\GeoLookup\GeoCoordinates                    Instance of this to make chaining possible
     */
    public function setLongitude($longitude) {
        // set the longitude
        $this->longitude = $longitude;
        
        // return the instance of this to make chaining possible
        return $this;
    }
    
}