<?php


use Entity\Place;
use Entity\PostType\PostTypeRepository;

class PlaceRepository extends PostTypeRepository
{

    public function __construct()
    {
        $this->machineName = Place::$MACHINE_NAME;
        parent::__construct();
    }

    /**
     * @param $id
     * @return bool|Place
     */
    public static function find($id)
    {
        return parent::find($id);
    }

}