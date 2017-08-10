<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadsManager;
use Excel;

use App\Models\Company;
use App\Models\Area;
use App\Models\User;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\ProductAddress;
use App\Models\ProductFunction;
use Illuminate\Support\Facades\Gate;

class LoadExcelController extends Controller
{

    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
        $this->middleware('auth');
    }
    /**
     * 上传文件
     */
    public function fileExplorer(Request $request,$type)
    {
        if (Gate::denies('modify-manager')) {
            abort(403,'你无权进行此操作！');
        }
        $folder = $type;
        $data = $this->manager->folderInfo($folder);
        return view('admin.upload.index', $data);
    }

    public function loadManager(Request $request)
    {
        if (Gate::denies('modify-manager')) {
            abort(403,'你无权进行此操作！');
        }
        $filename=$request->get('alllist_filename');
        $filePath = 'public/uploads/'.$filename;
        Excel::selectSheetsByIndex(0)->load($filePath, function($reader) {
            $reader->noHeading();
            $data = $reader->toArray();
            $alllist_datas=array_slice($data,2);

            foreach ($alllist_datas as $alllist_data) {
                //单位
                if (!trim($alllist_data[1])) break;
                $company = Company::where('companyname',trim($alllist_data[1]))->first();
                if (!$company){
                    $company = new Company();
                    $company->companyname=trim($alllist_data[1]);
                    $company->save();
                }
                
                //区域
                $area = Area::where('areaname',trim($alllist_data[2]))->first();
                if (!$area){
                    $area=new Area();
                    $area->areaname=trim($alllist_data[2]);
                    $area->save();
                }
                //类型
                $productType = ProductType::where('typename',trim($alllist_data[3]))->first();
                if (!$productType){
                    $productType=new ProductType();
                    $productType->typename=trim($alllist_data[3]);
                    $productType->save();
                }
                                
                //管理员
                $manager = new User();
                $manager->managername=trim($alllist_data[9]);
                $manager->manageraccount=trim($alllist_data[15]);
                $manager->company_id= $company->id;
                $manager->cellphone= trim($alllist_data[10]);
                $manager->verifyflag= 1;
                $manager->password= bcrypt(trim($alllist_data[16]));
                $manager->save();
                
                    //功能
                $productFunctions=[];
                $functionnames = explode(',',$alllist_data[7]); 
                foreach ($functionnames as $functionname) {
                    $productFunction = ProductFunction::where('functionname',trim($functionname))->first();
                    if (!$productFunction){
                        $productFunction=new ProductFunction();
                        $productFunction->functionname=trim($functionname);
                        $productFunction->save();
                    }
                    $productFunctions[]=$productFunction->id;
                }

                //地址
                $address = new ProductAddress();
                $address->productaddress=trim($alllist_data[4]);
                $address->longitude=trim($alllist_data[5]);
                $address->latitude=trim($alllist_data[6]);
                //场地
                $product = new Product();
                $product->productname= trim($alllist_data[3]);
                $product->areaname_id = $area->id;
                $product->producttype_id = $productType->id;
                $product->productexplain = trim($alllist_data[14]);
                $product->cellphone = trim($alllist_data[13]);
                $product->manager_id = $manager->id;
                $product->company_id = $company->id;
                $product->save();
                $product->functions()->attach($productFunctions);
                $product->address()->save($address);
            }
        });

        return redirect('/admin/product')
                        ->withSuccess("数据导入成功.");
        
    }

    public function loadArea(Request $request)
    {
        
    }
    
    public function loadType(Request $request)
    {

    }

    public function loadFunc(Request $request)
    {

    }
}