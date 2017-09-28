<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Models\staff;
use Input;
use DB;
use Models\dtControl;

use App\Repositories\fellowshipRepository;
use  App\Repositories\staffRepository;
use  App\Repositories\codtbldRepository;

class StaffController extends Controller
{
    private $staff;
    private $codtbld;
    private $fellowship;

    public function __construct(staffRepository $staffRepository,codtbldRepository $codtbldRepository,
                                fellowshipRepository $fellowshipRepository)
    {
        $this->staff=$staffRepository;
        $this->codtbld=$codtbldRepository;
        $this->fellowship = $fellowshipRepository;
    }


    public function show_elder_deacon()
    {
        $dtElders = $this->staff->getElder();
        \Debugbar::info($dtElders);
        $dtDeacons = $this->staff->getDeacon();

        $dtfellowship = $this->fellowshipRepository->getAll();

      return view('staff.elder_deacon',compact('dtfellowship','dtElders','dtDeacons'));
    }

    /*
      會長
    */
    public function ShowPresidency()
    {
        $dtPresidency = $this->staff->getPresidency();
        $dtfellowship = $this->fellowshipRepository->getAll();

        return view('staff.presidency',compact('dtfellowship','dtPresidency'));
    }

    public function MA_Staff()
    {
    	  $dtDuty = $this->codtbld->getWhere('duty');
        // $dtStaff = $this->dtStaff->getAll();
        $item=collect([]);
        foreach ($dtDuty as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->cod_id]=$key->cod_val;
        }

        $ItemAll=$item->all();

        /*
         * 2017/09/22  職務功能新增部門選項
         * */
        $dtDepart = $this->codtbld->getWhere('depart');
        $ItemDepart = collect([]);
        foreach ($dtDepart as $key) {
            # code...
            $ItemDepart[$key->cod_id]=$key->cod_val;
        }
        $ItemDepartAll=$ItemDepart->all();

        $dtFellowship = $this->fellowship->getAll();
        $ItemFellowship = collect([]);
        foreach ($dtFellowship as $key) {
            # code...
            $ItemFellowship[$key->id]=$key->NAME;
        }
        $ItemFellowshipAll=$ItemFellowship->all();


         $dtStaff=$this->staff->getOrderByPageing(9);

    	return view('DataMaintain.MA_Staff',compact('ItemAll','dtStaff','ItemDepartAll','ItemFellowshipAll'));

    }


  public function InsertItem(Request $request)
  {     
       // $this->staff->save($request);
       $Result = $this->staff->save($request);

       // $image = $request->file('image');
       $filename = $request->name;

        if($Result['ServerNo']=='200')
        {   
            if(!empty($request->file('image')))
            {
                $UploadResult = $this->staff->PhotoUpload($request,$Result['id']);
                
                if ($UploadResult['ServerNo']=='404')
                {
                    return back()->with('fails', $UploadResult['Result']);
                }
            }
            return back()->with('success', $Result['Result']);
        }else
        {
            return back()->with('fails', $Result['Result'][0]);
        }
  }

  public function UpdateItem(Request $request)
  {

        $Result = $this->staff->save($request);

        if($Result['ServerNo']=='200')
        {   
            if(!empty($request->file('image')))
            {
                $UploadResult = $this->staff->PhotoUpload($request,$Result['id']);
                
                if ($UploadResult['ServerNo']=='404')
                {   
                    return response()->json(['ServerNo' => '404','ResultData' => '圖片儲存失敗']);
                    // return back()->with('fails', $UploadResult['Result']);
                }
            }
            return response()->json(['ServerNo' => '200','ResultData' => $Result['Result']]);
            // return back()->with('success', $Result['Result']);
        }else
        {
             return response()->json(['ServerNo' => '404','ResultData' => $Result['Result']]);
        }


  }

  public function DeleteItem(Request $request)
  {
        \Debugbar::info($request->id);
         $Result = $this->staff->delete($request->id);

        return back()->with($Result['ServerNo'], $Result['Result']);
  }

  /*
    2017/08/21  新增“我們的牧師”這個view

  */
  public function show_our_pastor()
  {

        $dtfellowship = $this->fellowshipRepository->getAll();

        $dtPastor= $this->staff->getStaffD('1');
        \Debugbar::info($dtPastor);
      return view('staff.our_pastor',compact('dtfellowship','dtPastor'));
  }

  public function MA_our_pastor()
  {
    $dtControl=dtControl::all()->where('BLADE_NAME','MA_OurPastor');
    $dtPastor = $this->staff->getPastor();

     $item=collect(['choice'=>'請選擇']);
    // $item->push('新增年份');
    foreach ($dtPastor as $key) {
        # code...
        // $item->push($key->title);
        $item[$key->id]=$key->name;
    }

    $ItemAll=$item->all();


    return view('DataMaintain.MA_OurPastor',compact('dtControl','ItemAll','dtPastor'));

  }

  public function MA_OurPastor_D(Request $request)
  {
    $staff_id=$request->id;
    $staff_name=$request->name;
   
    $Data= $this->staff->getPastorD($staff_id,$staff_name);
    // \Debugbar::info($Data[0]->content);
    // $Result=$Data[0]->content;

    return   response()->json(['ServerNo' => '200','data' => $Data[0]]);
  }

  public function UpdateItemD(Request $request)
  {
         \Debugbar::info($request->staffd_id);
        // $staff_id=$request->staff_id;
       $Result = $this->staff->save_d($request);

        if($Result['ServerNo']=='200')
        {   
            return back()->with('success', $Result['Result']);
        }else
        {
            return back()->with('fails', $Result['Result']);
        }
  }

    /*
     * 2017/09/28   新增 職務查詢
     * */
    public function Search(Request $request)
    {
        \Debugbar::info($request->SearchName);

        /*
         * 下方為準備職務下拉選單的部分
         * */
        $dtDuty = $this->codtbld->getWhere('duty');
        // $dtStaff = $this->dtStaff->getAll();
        $item=collect([]);
        foreach ($dtDuty as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->cod_id]=$key->cod_val;
        }

        $ItemAll=$item->all();

        /*
         * 2017/09/22  職務功能新增部門選項
         * */
        $dtDepart = $this->codtbld->getWhere('depart');
        $ItemDepart = collect([]);
        foreach ($dtDepart as $key) {
            # code...
            $ItemDepart[$key->cod_id]=$key->cod_val;
        }
        $ItemDepartAll=$ItemDepart->all();

        /*
         * 下方為準備團契下拉選單部分
         * */
        $dtFellowship = $this->fellowship->getAll();
        $ItemFellowship = collect([]);
        foreach ($dtFellowship as $key) {
            # code...
            $ItemFellowship[$key->id]=$key->NAME;
        }
        $ItemFellowshipAll=$ItemFellowship->all();


        $dtStaff=$this->staff->query($request);

        return view('DataMaintain.MA_Staff',compact('ItemAll','dtStaff','ItemDepartAll','ItemFellowshipAll','request'));

//        return view('DataMaintain.MA_SundayVideo')->with('dtfellowship',$dtFellowship)->with('dtvideos',$dtVideos )->with('ItemAll',$ItemAll)->with('request',$request);
        //response()->json(['ServerNo'=>'200','ResultData'=>$this->videos->query($request)]);
    }


}