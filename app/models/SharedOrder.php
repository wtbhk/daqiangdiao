<?php

class Order extends Eloquent {
    
        protected $table = 'sharedorders';

        protected $softDelete = true; 

        function order()
        {
                return $this->belongsTo('Order');
        }

        function images()
        {
                return $this->morphMany('Image', 'imageable');
        }

        function orderitems()
        {
                return $this->order()->orderitems();
        }

}