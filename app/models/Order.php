<?php

class Order extends Eloquent {

	protected $table = 'orders';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        static $OPEN = 1;
        static $CHECKED = 2;
        static $DELIVERING = 3;
        static $COMPLETED = 4;
        static $CLOSED = 0;

        function user()
        {
                return $this->belongsTo('User');
        }

        function orderitems()
        {
                return $this->hasMany('OrderItem');
        }


}
