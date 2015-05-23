<?php

class Chef extends Eloquent {

	protected $table = 'chefs';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function scopeRank($query)
        {
                return $query->orderBy('rank', 'desc');
        }

        function scopeNew($query)
        {
                return $query->orderBy('created_at', 'desc');
        }

        function mainImage()
        {
                if($this->images()->first())
                        return $this->images()->first();
                return false;
        }

        function images()
        {
                return $this->morphMany('Image', 'imageable');
        }

        function avatar()
        {
                $image = $this->images()->first();
                if(!$image){
                        $image = new Image;
                        $image->file = '/images/default_avatar.jpg';
                }
                return $image;
        }

        function products()
        {
                return $this->belongsToMany('Product');
        }
}
