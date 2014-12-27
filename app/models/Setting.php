<?php

class Setting extends Eloquent {

	protected $table = 'settings';

        function get($key, $default=false)
        {
                $row = Setting::find($key)->first();
                if($row)
                        return $row['value'];
                if($default)
                        return Setting::set($key, $default);
                return false;
        }

        function set($key, $value)
        {
                if(!$key or !$value)
                        return false;
                if(Setting::find($key)->first())
                        $s = Setting::find($key)->first();
                else
                        $s = Setting::create(array('key'=>$key));
                $s->value = $value;
                $s->save();
                return $s->value;
        }

}
