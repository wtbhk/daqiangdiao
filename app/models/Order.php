<?php

class Order extends Eloquent {

	protected $table = 'orders';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function user()
        {
                return $this->belongsTo('User');
        }

        function orderitems()
        {
                return $this->hasMany('OrderItems');
        }


}
