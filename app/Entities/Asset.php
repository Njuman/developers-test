<?php namespace App\Entities;

class Asset extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 'assets';

    /**
     * @var array
     */
    protected $validation = array(
        // DO NOT EDIT
        'description' => '',
        'model' => 'required',
        'price' => 'required',
        'company' => 'required',
        // /DO NOT EDIT
    );
}
