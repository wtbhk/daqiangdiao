<?php

class SharedOrder extends Eloquent {
    
        protected $table = 'sharedorders';

        protected $primaryKey = 'order_id';

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

        function last_image()
        {
                return $this->images->orderBy('created_at', 'desc')->first();
        }
}