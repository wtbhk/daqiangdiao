<?php

class OrderItem extends Eloquent {

	protected $table = 'orderitems';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function product()
        {
                return $this->belongsTo('Product');
        }

        function order()
        {
                return $this->belongsTo('Order');
        }


}
