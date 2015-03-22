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
                return Image::where('imageable_id', $this->order_id)
                        ->where('imageable_type', 'SharedOrder')
                        ->latest();
        }
}