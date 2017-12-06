<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Validator;
use Response;

use  App\Repositories\SundayPreviewRepository;
use  App\Repositories\fellowshipRepository;
use  App\Repositories\dtControlRepository;
use  App\Repositories\codtbldRepository;

use DB;


class WorshipPreviewController extends Controller
{
    private $SundayPreview;
    private $Fellowship;
    private $TableControl;
    private $Codtble;

    public function __construct(fellowshipRepository $fellowshipRepository,SundayPreviewRepository $SundayPreviewRepository,dtControlRepository $dtControlRepository,codtbldRepository $codtbldRepository)
    {
        $this->SundayPreview = $SundayPreviewRepository;
        $this->Fellowship = $fellowshipRepository;
        $this->TableControl = $dtControlRepository;
        $this->Codtbld = $codtbldRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtfellowship =$this->Fellowship->getAll();
        $dtSundayPreview= $this->SundayPreview->getSundayPreviewInfo();
        $dtControl= $this->TableControl->getTableSetting('SundayPreview');
        $dtLanguage = $this->Codtbld->getWhere('language');
        \Debugbar::info($dtLanguage);
        return view('SundayPreview.SundayPreview')->with('dtControl',$dtControl)->with('dtfellowship',$dtfellowship)->with('dtSundayPreview',$dtSundayPreview)->with('dtLanguage',$dtLanguage);
    }

    public function MAWorshipPreview()
    {
        $language_type = "1,2";
        $speaker="";
        $subject = "";
        $sdate = date("Y-m-d");
        $edate=  date('Y-m-d',strtotime("{$sdate} +1 month"));
        $dtWorshipPreview= $this->SundayPreview->query($subject,$speaker,$sdate,$edate,$language_type);
        \Debugbar::info($dtWorshipPreview);
        $dtLanguage = $this->Codtbld->getWhere('language');
        return view('DataMaintain.MA_WorshipPreview')->with('sdate',$sdate)
            ->with('edate',$edate)
            ->with('speaker',$speaker)
            ->with('dtWorshipPreview',$dtWorshipPreview)
            ->with('dtLanguage',$dtLanguage);

    }

    public function SearchItem(Request $request)
    {
        $arrLanguage_type= $request->language_type;
        $arrCount=count($arrLanguage_type);
        $language_type='';
        for($i=0;$i<$arrCount;$i++)
        {
            if($arrLanguage_type[$i]!='0')
            {
                $language_type = $arrLanguage_type[$i].','.$language_type;
            }

        }

        $speaker=$request->speaker;
        $subject = $request->subject;
        $sdate = $request->sdate;
        $edate=  $request->edate;
        if($sdate=="")
        {
            $sdate = date("Y-m-d");
        }

        if($edate=="")
        {
            $edate=  date('Y-m-d',strtotime("{$sdate} +12 month"));
        }

        \Debugbar::info($language_type);
        $dtWorshipPreview= $this->SundayPreview->query($subject,$speaker,$sdate,$edate,$language_type);

        $dtLanguage = $this->Codtbld->getWhere('language');

        return view('DataMaintain.MA_WorshipPreview',compact('subject','sdate','edate','speaker','dtWorshipPreview','dtLanguage','arrLanguage_type'));
    }

    /*
        編輯信息資料維護的fun
    */
    public function EditItem(Request $request) {

        try {
            DB::connection()->getPdo()->beginTransaction();
            $Result=$this->SundayPreview->save($request);

            if($Result['ServerNo']=='200')
            {
                DB::connection()->getPdo()->commit();
                return response ()->json ( ['ServerNo'=>'200','ResultData'=> $Result['Result'],'Data'=>$Result['data']],200);
//            return back()->with('success', $Result['Result']);
            }else
            {
                DB::connection()->getPdo()->rollBack();
                return response ()->json ( ['ServerNo'=>'404','ResultData'=> $Result['Result']],403);
//            return back()->with('fails', $Result['Result'][0]);
            }


        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
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
        try{
            DB::connection()->getPdo()->beginTransaction();

            $id = Input::get('id');
            \Debugbar::info($id);

            $Result=$this->SundayPreview->delete($id);

            DB::connection()->getPdo()->commit();

            return response ()->json (['Message'=>$Result['Message']],200);

        }catch(\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }


    public function CreateItem(Request $request)
    {

        try {
            DB::connection()->getPdo()->beginTransaction();

            $Result=$this->SundayPreview->save($request);

            DB::connection()->getPdo()->commit();

            return back()->with('success', $Result['Message']);

            return $this->MAWorshipPreview();

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    public function UpdateItem(Request $request)
    {
        try {

            DB::connection()->getPdo()->beginTransaction();

            $Result=$this->SundayPreview->save($request);

            if($Result['ServerNo']=='200')
            {
                DB::connection()->getPdo()->commit();
                return response ()->json (['Message'=>$Result['Message'],'Data'=>$Result['data']],200);
            }else{
                DB::connection()->getPdo()->commit();
                return response ()->json (['Message'=>$Result['Message']],403);
            }

        }catch(\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json (['Message'=>$e->getMessage()],403);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //以下建構子是說，如果今天此頁面必須要是以登入者才能夠
    //看到，那就加入下面這段建構子，重點是 $this->middleware('auth');
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
}
