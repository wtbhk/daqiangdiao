<?php

class OrderItem extends Eloquent {

	protected $table = 'orderitems';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        //public $total = value(function(){return $this->total();});

        public function __get($name)
        {
                if($name == 'total')
                        return $this->total();
                return parent::__get($name);
        }


        function product()
        {
                return $this->belongsTo('Product');
        }

        function order()
        {
                return $this->belongsTo('Order');
        }

        function total()
        {
                return $this->price * $this->amount;
        }


}
