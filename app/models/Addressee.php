<?php

class Addressee extends Eloquent {

	protected $table = 'addressees';

        protected $guarded = ['id'];

        protected $softDelete = true; 

        function user()
        {
                return $this->belongsTo('User');
        }


}
