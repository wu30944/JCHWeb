<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\MeetingInfo;
use Models\dtControl;
use Models\fellowship;
use Input;
use Validator;
use Response;

class MeetInfoController extends Controller
{

    public function Ma_MeetingInfo()
    {
       $dtfellowship =fellowship::all();
       $dtMeetingInfo=MeetingInfo::all();
       $dtControl=dtControl::all();

        return view('DataMaintain.MA_MeetingInfo')->with('dtfellowship',$dtfellowship)->
        with('dtMeetingInfo',$dtMeetingInfo)->with('dtControl',$dtControl);
    }

    /*
        編輯聚會資訊的fun
    */
    public function editItem(Request $req) {

        $id = Input::get('id');
          // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'floor'       => 'required',
            'fellowship_name'        => 'required',
            'meeting_time'=>'required',
            'day'=>'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        \Debugbar::info($rules);

        // process the login
        if ($validator->fails()) {
            //return 1;
            return Response::json ( 
                array ('errors' => $validator->messages()->all() ));
        } else {
            // store
            $strMeetingInfo = MeetingInfo::find($id);
            $strMeetingInfo->name       = Input::get('fellowship_name');
            $strMeetingInfo->meeting_time      = Input::get('meeting_time');
            $strMeetingInfo->day = Input::get('day');
            $strMeetingInfo->floor = Input::get('floor');
            $strMeetingInfo->save();

            // redirect
            //\Session::flash('flash_message', 'Successfully updated nerd!');
            return response ()->json ( $strMeetingInfo );
        }
    }

    /*
        新增項目
    */
    public function AddItem(Request $request) {
        $rules = array (
            'floor'       => 'required',
            'fellowship_name'        => 'required',
            'meeting_time'=>'required',
            'day'=>'required'

        );

        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ()){
             return Response::json (
                array ('errors' => $validator->messages()->all() ));
        }
        else {
            $data = new MeetingInfo ();
            $data->name = $request->fellowship_name;
            $data->meeting_time = $request->meeting_time;
            $data->day = $request->day;
            $data->floor = $request->floor;
            $data->save ();

            // Session::flash('message', 'Successfully updated nerd!');
//            \Debugbar::info($request->meeting_time);
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

}
