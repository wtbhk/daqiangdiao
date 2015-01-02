<?php

class Order extends Eloquent {

	protected $table = 'orders';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        const OPEN = 1;
        const CHECKED = 2;
        const DELIVERING = 3;
        const COMPLETED = 4;
        const CLOSED = 0;

        function user()
        {
                return $this->belongsTo('User');
        }

        function orderitems()
        {
                return $this->hasMany('OrderItem');
        }

        function scopeNewest($query)
        {
                return $query->orderBy('created_at', 'desc');
        }

        function price()
        {
                return $this->orderitems->sum('price');
        }

}
