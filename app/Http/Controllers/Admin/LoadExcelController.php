<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoadExcelController extends Controller
{

    protected $manager;


    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;

    }
    /**
     * 上传文件
     */
    public function fileExplorer(Request $request,$type)
    {
        $folder = $type;
        $data = $this->manager->folderInfo($folder);

        return view('admin.upload.index', $data);
    }
    public function loadManager()
    {

    }

    public function loadArea(Request $request)
    {
        $filename=$request->get('arealist_filename');


        $filePath = 'public/uploads/'.$filename;

        Excel::selectSheetsByIndex(0)->load($filePath, function($reader) {
            $reader->noHeading();
            $data = $reader->toArray();
            $adplaylist_datas=array_slice($data,1);


            foreach ($adplaylist_datas as $adplaylist_data) {

                    $fre=Fre::where('fre',$adplaylist_data[3])->first();
                    $adplaylist=new ADPlayList;
                    $adplaylist->d_date=$adplaylist_data[1];
                    $adplaylist_time = explode('\'',$adplaylist_data[2]);

                    $adplaylist->b_time=$adplaylist_time[0].':'.$adplaylist_time[1];
                    $adplaylist->f_id=$fre->id;
                    $adplaylist->number=$adplaylist_data[4];
                    $adplaylist->len=$adplaylist_data[5];
                    $adplaylist->content=$adplaylist_data[6];
                    $adplaylist->belt=$adplaylist_data[7];
                    $adplaylist->ht_len=$adplaylist_data[8];

                    $adplaylist->save();
            }



        });
        return redirect('/admin/adplaylist')
                        ->withSuccess("收视率导入成功.");
    }

    
    public function loadType()
    {

    }

    public function loadFunc()
    {

    }
     /**
     * 导入广告播出记录
     */
    public function import(Request $request)
    {
        $filename=$request->get('adplaylist_filename');


        $filePath = 'public/uploads/'.$filename;

        Excel::selectSheetsByIndex(0)->load($filePath, function($reader) {
            $reader->noHeading();
            $data = $reader->toArray();
            $adplaylist_datas=array_slice($data,1);


            foreach ($adplaylist_datas as $adplaylist_data) {

                    $fre=Fre::where('fre',$adplaylist_data[3])->first();
                    $adplaylist=new ADPlayList;
                    $adplaylist->d_date=$adplaylist_data[1];
                    $adplaylist_time = explode('\'',$adplaylist_data[2]);

                    $adplaylist->b_time=$adplaylist_time[0].':'.$adplaylist_time[1];
                    $adplaylist->f_id=$fre->id;
                    $adplaylist->number=$adplaylist_data[4];
                    $adplaylist->len=$adplaylist_data[5];
                    $adplaylist->content=$adplaylist_data[6];
                    $adplaylist->belt=$adplaylist_data[7];
                    $adplaylist->ht_len=$adplaylist_data[8];

                    $adplaylist->save();
            }



        });
        return redirect('/admin/adplaylist')
                        ->withSuccess("收视率导入成功.");
    }

}
