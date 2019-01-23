<?php namespace App\Http\Controllers\Api\Version1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetRequest;
use App\Http\Requests\CompanyRequest;
use App\Entities\Company as Entity;
use App\Models\Company;
use App\Exceptions\BadRequestException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CompanyController extends Controller
{
    /**
     * @var Company
     */
    protected $companyModel;

    public function __construct(Company $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanies()
    {
        $companies = $this->companyModel->findAllCompanies();
        return response()->json($companies->toArray());
    }

    /**
     * @param CompanyRequest $companyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCompany(CompanyRequest $companyRequest)
    {
        try {
            $company = Entity::create($companyRequest->toArray());
            return response()->json($company->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompany($id)
    {
        $company = $this->companyModel->findById($id);
        return response()->json($company->toArray());
    }

    /**
     * @param $id
     * @param CompanyRequest $companyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function putCompany($id, CompanyRequest $companyRequest)
    {
        $company = $this->companyModel->findById($id);

        try {
            $company->update($companyRequest->toArray());
            return response()->json($company->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanyAssets($id)
    {
        $company = $this->companyModel->findById($id);
        $assets = $company->getAssets();

        return response()->json($assets->toArray());
    }

    /**
     * @param $id
     * @param AssetRequest $assetRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCompanyAsset($id, AssetRequest $assetRequest)
    {
        $company = $this->companyModel->findById($id);

        try {
            $asset =  $company->addAsset($assetRequest->toArray());
        } catch (BadRequestException $e) {
            throw new HttpResponseException(response()->json($e->toArray(), $e->getCode()));
        }

        return response()->json($asset->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request) {
        if($request->hasfile('logo'))
        {
            $image = $request->file('logo');
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $filename = time().'.'.$extension;

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(100, 100);
            $image_resize->save(public_path('uploads/logo/' .$filename));

            return response()->json(['url' => url('uploads/logo/'.$filename)]);
        }
    }
}
