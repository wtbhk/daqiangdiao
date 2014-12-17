<?php

class Image extends Eloquent {

	protected $table = 'images';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function imageable()
        {
                return $this->morphTo();
        }


}
