<?php

class Addressee extends Eloquent {

	protected $table = 'addressees';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        static function boot()
        {
                parent::boot();
                Addressee::created(function($addressee)
                {
                        if(!$addressee->user->phone)
                                $addressee->user->phone = $addressee->phone;
                        if(!$addressee->user->name)
                                $addressee->user->name = $addressee->name;
                });
        }

        function user()
        {
                return $this->belongsTo('User');
        }


}
