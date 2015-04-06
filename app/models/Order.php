<?php

class Order extends Eloquent {

	protected $table = 'orders';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        const OPEN = 1;
        const CHECKED = 2;
        const DELIVERING = 3;
        const COMPLETED = 4;
        const CLOSED = 0;

        function user()
        {
                return $this->belongsTo('User');
        }

        function sharedorder()
        {
                return $this->hasOne('SharedOrder');
        }

        function orderitems()
        {
                return $this->hasMany('OrderItem');
        }

        function scopeNewest($query)
        {
                return $query->orderBy('created_at', 'desc');
        }

        function price()
        {
                return $this->orderitems->sum('price');
        }

        function isDeliveryNow()
        {
                $dt = Carbon::parse($this->delivery);
                return ($dt->hour + $dt->minute + $dt->second == 0) ? true : false;
        }

        function next_step_chn()
        {
                $list = array(
                        Order::OPEN => '接受',
                        Order::CHECKED => '发货',
                        Order::DELIVERING => '完成'
                );
                return $list[$this->status];
        }

        function status_chn()
        {
                switch ($this->status)
                {
                        case Order::OPEN:
                                return '进行中';
                        case Order::CHECKED:
                                return '已确认';
                        case Order::DELIVERING:
                                return '派送中';
                        case Order::COMPLETED:
                                return '已完成';
                        case Order::CLOSED:
                                return '已关闭';
                }
        }
}
