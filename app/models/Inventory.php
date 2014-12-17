<?php

class Inventory extends Eloquent {

	protected $table = 'inventory';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function product()
        {
                return $this->hasOne('Product');
        }

}
