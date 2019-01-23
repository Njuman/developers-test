<?php namespace App\Entities;

use App\Exceptions\BadRequestException;
use App\Models\Asset;
use App\Entities\Asset as AssetEntity;

class Company extends BaseEntity
{
    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var array
     */
    protected $validation = array(
        // DO NOT EDIT
        'name' => 'required',
        'email' => 'required|email',
        // /DO NOT EDIT
    );

    /**
     * @return \App\Entities\Asset
     */
    public function getAssets() {
        return Asset::findByCompanyId($this->id);
    }

    /**
     * @param $data
     * @throws BadRequestException
     */
    public function addAsset($data) {
        $data['company'] = $this->id;

        try {
            $asset = AssetEntity::create($data);
        } catch (BadRequestException $e) {
            throw $e;
        }

        return $asset;
    }
}
