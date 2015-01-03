<?php

class Inventory extends Eloquent {

	protected $table = 'inventory';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        static function boot()
        {
                parent::boot();
                Inventory::creating(function($inventory)
                {
                        if(!$inventory->inventory)
                                $inventory->inventory = $inventory->product->inventory_per_day;
                });
        }

        function product()
        {
                return $this->belongsTo('Product');
        }

        function scopeWhen($query, $date)
        {
                return $query->whereDate($date);
        }

        function setDateAttribute($value)
        {
                $this->attributes['date'] = date('Y-m-d', strtotime($value));
        }

}
