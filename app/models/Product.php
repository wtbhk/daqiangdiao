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

        function getPriceAttribute($price)
        {
                return number_format($price, 1, '.', '');
        }

        function inventory_in($date)
        {
                $inventory = Inventory::firstOrCreate(array(
                                        'product_id'=>$this->id,
                                        'date'=>$date
                                ));
                return $inventory->inventory;
        }

        function inventory_today()
        {
                return $this->inventory_in(date('Y-m-d'));
        }

        function needReservation()
        {
                if($this->reservation_day > 0)
                        return true;
                return false;
        }

        function chineseReservation()
        {
                $num_list = array(
                        1 => '一',
                        2 => '二',
                        3 => '三',
                        4 => '四',
                        5 => '五',
                        6 => '六',
                        7 => '七',
                        8 => '八',
                        9 => '九',
                        10=> '十'
                );
                if($this->reservation_day<=0 or $this->reservation_day>10)
                        return false;
                return $num_list[$this->reservation_day];
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

        function one_image_url()
        {
                if($this->images()->first())
                        return $this->images()->first()->file;
                return '/images/default.jpg';
        }

}
