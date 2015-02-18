<?php

class Payment extends Eloquent{

	protected $table 		= 'payments';
	protected $primaryKey 	= 'id';

	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/
	public function order()
    {
        return $this->belongsTo('Order');
    }

}
