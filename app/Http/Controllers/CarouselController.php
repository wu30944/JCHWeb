<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use DB;
use Models\dtControl;

use App\Repositories\CarouselRepository;

class CarouselController extends Controller
{
    private $objCarousel;

    public function __construct(CarouselRepository $CarouselRepository)
    {
        $this->objCarousel=$CarouselRepository;
    }

    public function MA_Carousel()
    {
//        $dtCarousel = $this->objCarousel->all();


        $dtCarousel=$this->objCarousel->getOrderByPageing(9);

         return view('DataMaintain.MA_Carousel',compact('dtCarousel');

    }


    public function show()
    {
       $dtDuty = $this->codtbld->getWhere('duty');
        $dtStaff = $this->staff->getAll();

        $dtfellowship = $this->fellowshipRepository->getAll();
         $item=collect(['choice'=>'請選擇']);
        // $item->push('新增年份');
        foreach ($dtDuty as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->cod_id]=$key->cod_val;
        }

        $ItemAll=$item->all();

      return view('staff.elder_deacon',compact('dtfellowship','ItemAll','dtStaff'));
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
    $dtfellowship = $this->fellowshipRepository->getAll();
    $dtPastor = $this->staff->getPastor();

     $item=collect(['choice'=>'請選擇']);
    // $item->push('新增年份');
    foreach ($dtPastor as $key) {
        # code...
        // $item->push($key->title);
        $item[$key->id]=$key->name;
    }

    $ItemAll=$item->all();


    return view('DataMaintain.MA_OurPastor',compact('dtfellowship','dtControl','ItemAll','dtPastor'));

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


}