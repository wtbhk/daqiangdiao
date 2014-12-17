<?php

class Video extends Eloquent {

	protected $table = 'videos';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function product()
        {
                return $this->belongsTo('Product');
        }


}
