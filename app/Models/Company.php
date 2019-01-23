<?php namespace App\Models;

use App\Entities\BaseEntityCollection;
use App\Entities\Company as Entity;

class Company extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var array
     */
    protected $fillable = ['name','email','logo','website'];

    /**
     * @return BaseEntityCollection
     */
    public function findAllCompanies() {
        $attr = static::all()->toArray();
        return new BaseEntityCollection($attr, 'App\Entities\Company');
    }

    /**
     * @param $id
     * @return Entity
     */
    public function findById($id) {
        $attr = static::find($id)->toArray();
        return new Entity($attr);
    }
}
