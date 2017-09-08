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


class FellowshipController extends Controller
{
	public function index()
	{

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
        \Debugbar::info($req->PARA_1);
         //根據使用者選擇的資訊，將資料明細帶出
        $fellowship_info=DB::select('SELECT * FROM fellowship_d b
                                    where b.id=?', [$req->PARA_1]);
        \Debugbar::info($fellowship_info);
            // redirect
            //\Session::flash('flash_message', 'Successfully updated nerd!');
        return response ()->json ( $fellowship_info );

    }


    /*
        編輯團契資訊的function 
    */
    public function editItem(Request $request) {

         $rules = array (
            'introduction_title'=> 'required',
            'introduction_content'=> 'required',
            'page_one_title'=>'required',
            // 'page_two_title'=>'required',
            // 'page_three_title'=>'required',
            // 'page_four_title'=>'required',
            'page_one_content'=>'required',
            // 'page_two_content'=>'required',
            // 'page_three_content'=>'required',
            // 'page_four_content'=>'required',
            'id'=>'required'

        );

        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ()){       
             return Response::json ( 
                array ('errors' => $validator->messages()->all() ));
        }
        else {
            \Debugbar::info($request);
            $data = fellowship_d::find($request->id);
            $data->introduction_title = $request->introduction_title;
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

            // Session::flash('message', 'Successfully updated nerd!');
            return response ()->json ( $data );
   

        }
    }

    /*
        新增項目
    */
    public function AddItem(Request $request) {

        $rules = array (
            'introduction_title'=> 'required',
            'introduction_content'=> 'required',
            'page_one_title'=>'required',
            'page_two_title'=>'required',
            'page_three_title'=>'required',
            'page_four_title'=>'required',
            'page_one_content'=>'required',
            'page_two_content'=>'required',
            'page_three_content'=>'required',
            'page_four_content'=>'required'

        );

        \Debugbar::info('234');
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ()){       
             return Response::json ( 
                array ('errors' => $validator->messages()->all() ));
        }
        else {
            \Debugbar::info($request);
            $data = fellowship_d::find($request->id);
            $data->introduction_title = $request->introduction_title;
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

            // Session::flash('message', 'Successfully updated nerd!');
            return response ()->json ( $data );
   

        }
    }
    /*
        刪除被選到的項目
    */
    public function DeleteItem(Request $request)
    {   
        // MeetingInfo::find ( $request->id )->delete ();
        // return response ()->json ();

        
        $id = Input::get('id');
        \Debugbar::info($id);
        $strMeetingInfo = MeetingInfo::find($id)->delete();
        //MeetingInfo::find ( $request->id )->delete ();
        return response ()->json ();
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
            
            $destinationPath = public_path().env('PHOTO_PATH').$catalog;


            if (!is_dir($destinationPath))
            {
                mkdir($destinationPath);
            }
            
            //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
            $filename = $request->get('id').'.jpg';//$file->getClientOriginalName();

            $data = fellowship_d::find($request->get('id'));
            $data->image_path = env('PHOTO_PATH').$catalog.'/'.$filename;
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

}