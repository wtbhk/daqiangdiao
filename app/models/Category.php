<?php

class Category extends Eloquent {

	protected $table = 'categories';

        protected $guarded = ['id'];

        function products()
        {
                return $this->hasMany('Product');
        }

        function scopeRank($query)
        {
                return $query->orderBy('rank', 'desc');
        }
}
