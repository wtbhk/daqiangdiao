<?php

class Setting extends Eloquent {

	protected $table = 'settings';

        protected $primaryKey = 'key';

        protected $fillable = array('key', 'value');

        public $timestamps = false;

        static function get($key, $default=false)
        {
                $row = Setting::find($key);
                if($row)
                        return $row->value;
                if($default)
                        return Setting::set($key, $default);
                return false;
        }

        static function set($key, $value)
        {
                if(!$key or !$value)
                        return false;
                if(Setting::find($key))
                        $s = Setting::find($key);
                else
                        $s = Setting::create(array('key'=>$key));
                $s->value = $value;
                $s->save();
                return $s->value;
        }

}
