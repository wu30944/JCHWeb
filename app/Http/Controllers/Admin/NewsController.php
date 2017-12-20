<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\MeetingInfo;
use Models\Category;
use Models\dtControl;
use Input;
use DB;


use App\Repositories\fellowshipRepository;
use  App\Repositories\NewsRepository;
use App\Repositories\CategoryRepository;

class NewsController extends Controller
{

    private $fellowshipRepository;
    private $dtNews;
    private $categories;

    public function __construct(fellowshipRepository $fellowshipRepository
                                ,NewsRepository $NewsRepository
                                ,CategoryRepository $CategoryRepository)
    {
        $this->fellowshipRepository=$fellowshipRepository;
        $this->dtNews=$NewsRepository;
        $this->categories = $CategoryRepository;//Category::where('parent_id', '=', 0)->get();
    }

    public function MA_News()
    {

        // $dtNews = $this->dtNews->getAll();

        $dtNews = $this->dtNews->getAll()->sortByDesc('created_at');


        $dtControl=dtControl::all()->where('BLADE_NAME','MA_News');
        //$test = new NewsRepository();

        $dtfellowship = $this->fellowshipRepository->getAll(); //fellowship::all();
        $isPaging=true;
          
          //Debug專用
         \Debugbar::info( date("m"));

        return view('DataMaintain.MA_News',compact('dtfellowship','dtControl'),compact('dtNews','isPaging'));
    }

    public function editItem(Request $request)
    {
         \Debugbar::info( $request->id );

        $data=$this->dtNews->find($request->id);

         //Debug專用
         \Debugbar::info( $data );

        return response ()->json ( $data );
    }



    public function saveItem(Request $request)
    {   
//         \Debugbar::info('1');
        //return $this->dtNews->save($request);
        $Result = $this->dtNews->save($request);

        if($Result['ServerNo']=='200')
        {
            return response ()->json (['ServerNo'=>'200','content'=>$Result['content'],'Message'=>$Result['Message']]);

            //return response ()->json ( ['ServerNo'=>'200','ResultData'=> $Result['Result'],'data'=>$Result['data']]);
        }else
        {
            return response ()->json ( ['ServerNo'=>'404','Message'=>$Result['Message']]);
        }
    }



    /*
        2017/10/16    參考金句資料維護功能的新增function

    */
    public function UpdateItem(Request $request) {
//
//        if(!empty($request->file('image')))
//        {
//            \Debugbar::info('有照片');
//        }else{
//            \Debugbar::info('無照片');
//        }
        try{
            DB::connection()->getPdo()->beginTransaction();

            $Result=$this->dtNews->save($request);

            if($Result['ServerNo']=='200')
            {
                if(!empty($request->file('image')))
                {
                    $UploadResult = $this->dtNews->CreatePhotoUpload($request,$Result['id']);//$this->staff->PhotoUpload($request,$Result['id']);

                    if ($UploadResult['ServerNo']=='404')
                    {
                        DB::connection()->getPdo()->rollBack();
                        return response ()->json ( ['ServerNo'=>'404','Message'=>$UploadResult['Result']],404);
                    }
                }
                DB::connection()->getPdo()->commit();
                return response ()->json ( ['ServerNo'=>'200','ResultData'=> $Result['data'],'Message'=>$Result['Message'],'content'=>$Result['content']],200);
            }else
            {
                DB::connection()->getPdo()->rollBack();
                return response ()->json ( ['ServerNo'=>'404','Message'=>$Result['Message'],'Key'=>$Result['Key']],404);
            }

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['ServerNo'=>'404','Message'=>$Result['Message'],'Key'=>$Result['Key']],404);
        }

    }


    /*
     * 20171102  將try catch從裡邊拿出來，直接放在外面
     * */
    public function InsertItem(Request $request)
    {
//        if(!empty($request->file('image')))
//        {
//            return '有照片';
//            //\Debugbar::info('有照片');
//        }else{
//
//            return '無照片';
//            //\Debugbar::info('無照片');
//        }

        try{
            DB::connection()->getPdo()->beginTransaction();
            $Result = $this->dtNews->save($request);
            $this->categories->AutoCreateCategory();
            if($Result['ServerNo']=='200')
            {
                if(!empty($request->file('image')))
                {
                    $UploadResult = $this->dtNews->CreatePhotoUpload($request,$Result['id']);//$this->staff->PhotoUpload($request,$Result['id']);

                    if ($UploadResult['ServerNo']=='404')
                    {
                        return back()->with('fails', $UploadResult['Result']);
                    }
                }
                DB::connection()->getPdo()->commit();
                return back()->with('success', $Result['Message']);
            }else
            {
                DB::connection()->getPdo()->rollBack();
                return back()->with('fails', $Result['Message']);
            }

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return back();
        }
    }

    public function PhotoUpload(Request $request)
    {
        $file = $request->file('image');
        // \Debugbar::info($file);
        $catalog='/news';

        //必須是image的驗證
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'ServerNo' => '404',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{       
            
            $destinationPath = public_path().config('app.news_photo_path');

            // \Debugbar::info($destinationPath);

            if (!is_dir($destinationPath))
            {
                mkdir($destinationPath);
            }
            //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
            $filename = $request->get('id').'.jpg';//$file->getClientOriginalName();


            $data = $this->dtNews->find($request->get('id'));
            $data->image = config('app.news_photo_path').'/'.$filename;
            $data->save();


            //  移動檔案
            if(!$file->move($destinationPath,$filename)){
                return response()->json(['ServerNo' => '400','ResultData' => '圖片儲存失敗']);
            }

            return response()->json(['ServerNo' => '200','ResultData' => $data->image]);
        }
    }



    public function DeleteItem(Request $request)
    {
        return $this->dtNews->delete($request->get('id'));
    }

    public function DeletePhoto($FileName)
    {
        $destinationPath = public_path().config('app.fellowship_photo_path').'/'.$FileName;
        if(file_exists($destinationPath)){
            unlink($destinationPath);//將檔案刪除
        }else if(file_exists($destinationPath)){

            unlink($destinationPath);
        }else{
            echo 'Not Found Photo';
        }
    }

    // 2017/06/03  增加最新消息頁面，點選畫面中Read More 進入消息明細
    public function ReadMore(Request $request)
    {

        $dtNews_d=$this->dtNews->find($request->id);

        $total_html="";

        foreach($dtNews_d as $data)
            {   
                $link_html="";
                $link_html='<h2>'.$data->title.'</h2><p><span class="glyphicon glyphicon-time"></i>&nbsp'.$data->action_date.'</p>';
                if($data->image!=="")
                {
                    $link_html=$link_html.'<img class="img-responsive img-hover" src="'.$data->image.'" alt="" style="max-width: 400; max-height: 200px;">';
                }

                $link_html=$link_html.'<br><p>'.$data->content.'</p><hr>';

                $total_html=$total_html.$link_html;
            }

        return response ()->json ( $dtNews_d );
    }


}
