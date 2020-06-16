<?php
namespace Entity\Place;

use Entity\PostType\PostTypeRepository;
use Entity\Place;

class PlaceRepository extends PostTypeRepository
{
    public function __construct()
    {
        $this->machineName = Place::$MACHINE_NAME;
        parent::__construct();
    }

	/**
	 * Get latest Report
	 *
	 * @param int  $count
	 * @param bool $returnQuery
	 * @return array|bool|[Review]
	 */
	public static function getLatest($count = 10, $returnQuery = false)
	{
		$result = self::findSmartAll([], [
			'count'     => $count
		], $returnQuery);

		return $result;
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