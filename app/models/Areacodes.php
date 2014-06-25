<?php

class Areacodes extends Eloquent {

	protected $fillable = array('id', 'area_code','area_covered','official_Ofcom' , 'Previous_BT');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'areacodes';

}