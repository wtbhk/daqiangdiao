<?php

class SharedOrder extends Eloquent {
    
        protected $table = 'sharedorders';

        protected $fillable = array('order_id', 'content');

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