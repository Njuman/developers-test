<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @var array
     */
    protected static $cache = array();

    /**
     * @param string $key
     * @param Callable $func
     * @return mixed
     */
    protected static function persist($key, $func)
    {
        if ( ! isset(self::$cache[$key])) {
            self::$cache[$key] = $func();
        }
        return self::$cache[$key];
    }
}

