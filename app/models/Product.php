<?php

class Product extends Eloquent {

	protected $table = 'products';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function inventory()
        {
                return $this->hasMany('Inventory');
        }

        function images()
        {
                return $this->morphMany('Image', 'imageable');
        }

        function video()
        {
                return $this->hasOne('Video');
        }


}
