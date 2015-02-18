<?php

class Order extends Eloquent{

	protected $table 		= 'orders';
	protected $primaryKey 	= 'id';
	
	/*====================================================================================================================================
	| RELATIONSHIPS
	/*====================================================================================================================================*/
	public function status()
    {
        return $this->belongsTo('OrderStatus','code','order_status');
    }

    public function payment(){
    	return $this->belongsTo('Payment');
    }

}
