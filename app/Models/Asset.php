<?php namespace App\Models;

use App\Entities\Asset as Entity;

class Asset extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * @var array
     */
    protected $fillable = ['description','model','price','company'];

    /**
     * @param $id
     * @return Entity
     */
    public static function findByCompanyId($id) {
        $attr = static::where('company', '=', $id)->get()->toArray();
        return new Entity($attr);
    }
}
