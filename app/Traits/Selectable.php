<?php
/**
 * Created by PhpStorm.
 * User: марк
 * Date: 19.02.2018
 * Time: 19:42
 */

namespace App\Traits;


trait Selectable
{
    public static function getSelectList($value = 'name', $key = 'id'){

        return static::latest()->owned()->pluck($value, $key);
    }
}