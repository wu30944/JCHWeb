<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\MeetingInfo;
use Models\fellowship;
use Models\dtControl;
use Models\fellowship_d;
use Input;
use DB;
use Validator;
use Redirect;

use App\Repositories\FellowshipRepository;


class FellowshipController extends Controller
{

    private $fellowshipRepository;

    public function __construct(fellowshipRepository $fellowshipRepository)
    {
        $this->fellowshipRepository=$fellowshipRepository;
    }


    public function MA_Fellowship()
    {
       $dtfellowship =fellowship::all();
       $dtMeetingInfo=MeetingInfo::all();
       //將該資料表所設定的控制項資訊讀取出來
       $dtControl=dtControl::all()->where('BLADE_NAME','MA_Fellowship');

       \Debugbar::info($dtfellowship);

        return view('DataMaintain.MA_Fellowship')->with('dtfellowship',$dtfellowship)->
        with('dtMeetingInfo',$dtMeetingInfo)->with('dtControl',$dtControl);
    }

    public function MA_Fellowship_D(Request $req)
    {
         //根據使用者選擇的資訊，將資料明細帶出
        $fellowship_info=$this->fellowshipRepository->getFellowshipD($req->ID);
            /*DB::select('SELECT * FROM fellowship_d b
                                    where b.id=?', [$req->PARA_1]);*/

            //\Session::flash('flash_message', 'Successfully updated nerd!');
        return response ()->json ( $fellowship_info );

    }


    /*
        編輯團契資訊的function 
    */
    public function editItem(Request $request) {
        try{
            DB::connection()->getPdo()->beginTransaction();

            $rules = array (
                'introduction_title'=> 'required',
                'id'=>'required'
            );


            $messages = ['introduction_title.required' => '團契名稱不能空白'
                        ,'id.required'=>'程式有問題'];

            $validator = Validator::make ( $request->all (), $rules, $messages );
            if ($validator->fails ()){
    //             return Response::json (
    //                array ('errors' => $validator->messages()->all() ));
                return response ()->json ( ['ServerNo' => '404','Result' => $validator->messages()->all() ]);
            }
            else {
    //            \Debugbar::info($request);
                $data = fellowship_d::find($request->id);
                $data->introduction_title = $request->introduction_title;
                $data->name = $request->introduction_title;
                $data->introduction_content = $request->introduction_content;
                $data->page_one_title = $request->page_one_title;
                $data->page_two_title = $request->page_two_title;
                $data->page_three_title = $request->page_three_title;
                $data->page_four_title = $request->page_four_title;
                $data->page_one_content = $request->page_one_content;
                $data->page_two_content = $request->page_two_content;
                $data->page_three_content = $request->page_three_content;
                $data->page_four_content = $request->page_four_content;
                $data->save ();

                $objFellowship = fellowship::find($data->fellowship_id);
                $objFellowship->name=$request->introduction_title;
                $objFellowship->save ();

                MeetingInfo::where('fellowship_id','=',$data->fellowship_id)
                                 ->update(['name'=>$request->introduction_title]);

                DB::connection()->getPdo()->commit();
                // Session::flash('message', 'Successfully updated nerd!');
                return response ()->json (['ServerNo'=>'200','Result'=> $data ]);

            }
        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }
    }

    /*
        新增項目
    */
    public function AddItem(Request $request) {
        $Result=$this->fellowshipRepository->save($request);
        if($Result['ServerNo']=='200') {
            return back()->with('success', $Result['Result']);
        }
        else{
            return back()->with('fails', $Result['Result']);
        }
    }
    /*
        刪除被選到的項目
    */
    public function DeleteItem(Request $request)
    {
//        return $request->FellowshipId;
        if($request->FellowshipId!="")
        {
            $Result=$this->fellowshipRepository->delete($request->FellowshipId);
            if($Result['ServerNo']=='200')
                return back()->with('success', $Result['Result']);
            elseif($Result['ServerNo']=='404')
                return back()->with('fails',$Result['Result']);
        }
        else{
            return back()->with('fails', '資料庫有誤');
        }

    }


    /*
        上傳圖片的function
        2017/05/13 
    */
    public function PhotoUpload(Request $request)
    {   
        $file = $request->file('image');

        $catalog='/fellowship';

        //必須是image的驗證
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );

        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{

            $destinationPath = public_path().config('app.fellowship_photo_path');


            if (!is_dir($destinationPath))
            {
                mkdir($destinationPath);
            }

            //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
            $filename = $request->get('id').'.jpg';

            $data = fellowship_d::find($request->get('id'));
            $data->image_path = config('app.fellowship_photo_path').'/'.$filename;
            $data->save();


            //  移動檔案
            if(!$file->move($destinationPath,$filename)){
                return response()->json(['ServerNo' => '400','ResultData' => '圖片儲存失敗']);
            }

            return response()->json(['ServerNo' => '200','ResultData' => $data->image_path]);
        }
        // return \Response::json([
        //     'success' => true,
        //     'name' => $filename,
        // ]);
        
    }

    /*
        點選導覽列的團契生活，到資料庫抓取Blade檔案名稱
        與存放在哪個目錄下，再把它給串接起來
    */
    public function ShowFellowship($id)
    {
        $dtfellowship = $this->fellowshipRepository->getAll();
        $fellowship_info=$this->fellowshipRepository->getFellowshipD($id);
           /* DB::select('SELECT * FROM fellowship_d a
                            where a.fellowship_id=?', [$id]);*/

        foreach($fellowship_info as $value)
        {
            $page_title=$value->name;
        }


        return view('fellowship.fellowship_info')->with('dtfellowship',$dtfellowship)
                                                        ->with('fellowship_info',$fellowship_info)
                                                        ->with('page_title',$page_title);
    }


}