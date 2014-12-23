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

        function scopeRank($query)
        {
                return $query->orderBy('rank', 'desc');
        }

        function scopeNew($query)
        {
                return $query->orderBy('created_at');
        }

        function scopeAvailable($query)
        {
                return $query->where('available', true);
        }

        function inventory_in($date)
        {
                return $this->inventory->when($date)->firstOrCreate(array(
                        'product_id'=>$this->id,
                        'date'=>$date,
                        'inventory'=>$this->inventory_per_day
                ));
        }

        function checkInventory($qty, $date)
        {
                if($this->ignore_inventory)
                        return true;
                if($qty <= $this->inventory_in($date))
                        return true;
                return false;
        }

        function checkReservation($date)
        {
                $days = round((strtotime($date)-strtotime(date('Y-m-d')))/3600/24);
                if($days < $this->reservation_day)
                        return false;
                return true;
        }

}
