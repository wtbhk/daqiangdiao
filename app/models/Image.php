<?php

class Image extends Eloquent {

	protected $table = 'images';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function imageable()
        {
                return $this->morphTo();
        }

        function scopeLatest($query)
        {
        	return $query->orderBy('created_at', 'desc')->first();
        }

        function resize($w, $h)
        {
                return ImageHelper::path($this->file, 'resizeCrop', $w, $h);
        }

}
