<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{

	
	/** Refactor code using OOP */
	protected $_vehicleType = ['sport-car', 'truck', 'bike', 'boat'];
	protected $_vehicleSpeed = [160, 60, 100, 50];
	protected $_distance = 350;

	public function refactor()
  {
		foreach ( $this->_vehicleType as $key => $type ) {
			if ( isset( $this->_vehicleSpeed[$key]) ) {
				$result = $this->_calulateDurationByType($type, $this->_vehicleSpeed[$key]);
				// Display out put
				echo $type.':  '.$result;
				echo "<br />";
			}
		}
  }

	protected function _calulateDurationByType($type, $speed)
	{
		$result = null;
		$add = 0;
		if ( 'boat' === $type ) {
			$add = 0.25;
		}
		$result = (($this->_distance / $speed) + $add);

		return $result;	
	}
 

	/** Logic Test */
	protected $_array = [5, 4, 7, 0, 8, 1, 9, 2];	// Change input array here
	public function logic()
  {

		echo 'Before: ';
		echo implode(', ', $this->_array);
		echo "<br />";

		$results = $this->_transformedArray($this->_array);

		echo 'After: ';
		echo implode(', ', $results);
		echo "<br />";

	}
	
	protected function _transformedArray(array $array) : array
	{
		$results = [];
		$firstPosition = true;
		$lastZero = [];

		while( count($array) ) {
			$value = array_shift($array);

			if( $value ) {	// Not Zero	// Push end of array
				array_push($results, $value);
			}else {
				if( $firstPosition ) {
					array_unshift($results, $value);
				}else {
					array_push($lastZero, $value); 
				}
				$firstPosition = ($firstPosition === true) ? false : true;				
			}

		}
		// Merge end array
		if( $lastZero ) {
			array_push($results, implode(',', $lastZero));
		}

		return $results;
	}
}
