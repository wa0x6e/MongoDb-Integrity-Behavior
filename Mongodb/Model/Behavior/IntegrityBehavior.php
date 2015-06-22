<?php
/**
 * Integrity Behavior
 *
 * Convert back all the mongoDb object from a find action to a string.
 *
 * PHP 5
 *
 * Copyright (c) 2012, Wan Chen aka Kamisama
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 	Copyright (c) 2012, Wan Chen aka Kamisama
 * @author 		Wan Chen <kami@kamisama.me>
 * @link        http://blog.kamisama.me
 * @package     Mongodb
 * @subpackage 	Mongodb.Model.Behavior
 * @version 	0.1
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Integrity Behavior
 *
 * Convert back all the mongoDb object from a find action to a string.
 *
 * To be used with the mongodb datasource plugin (https://github.com/ichikaway/cakephp-mongodb)
 * to get rid of the mongodb object returned by mongom such as MongoId and MongoDate.
 *
 * Place this file in the Plugin/Mongodb/Model/Behavior
 * and start using by adding the behavior in your model
 * e.g :
 * 		public $actsAs = array('Mongodb.Integrity);
 *
 * @uses        ModelBehavior
 * @package     Mongodb
 * @subpackage 	Mongodb.Model.Behavior
 */
class IntegrityBehavior extends ModelBehavior
{
	/**
	 * After find callback
	 *
	 * @see ModelBehavior::afterFind()
	 * @since 0.1
	 */
	public function afterFind(Model $Model, $results, $primary)
	{
		return $this->__compact($Model, $results);
	}
	
	
	/**
	 * Recursively convert all mongodb object to string
	 *
	 * @param Model $Model
	 * @param array $data results from a find actions
	 * @return array
	 * @since 0.1
	 */
	private function __compact(Model $Model, $data)
	{
		$r = array();
		if (is_array($data) && is_array(array_values($data)))
		{
			foreach($data as $dta => $k)
				$r[$dta] = $this->__compact($Model, $k);
			return $r;
		}
		else
		{
			if ($data instanceof MongoId)
				return $data->{'$id'};
			elseif ($data instanceof MongoDate)
				return date('Y-m-d H:i:s', $data->sec);
			else return $data;
		}
	}
}
