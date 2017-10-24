<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use DB;
use Models\carousel;

use App\Repositories\CarouselRepository;

class CarouselController extends Controller
{
    private $objCarousel;

    public function __construct(CarouselRepository $CarouselRepository)
    {
        $this->objCarousel=$CarouselRepository;
    }

    public function MACarousel()
    {
//        $dtCarousel = $this->objCarousel->all();


        $dtCarousel=$this->objCarousel->getOrderByPageing(9);

         return view('DataMaintain.MA_Carousel',compact('dtCarousel'));

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
       $Result = $this->objCarousel->save($request);

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
            return back()->with('success', $Result['Message']);
        }else
        {
            return back()->with('fails', $Result['Message'][0]);
        }
  }


  public function DeleteItem(Request $request)
  {
        //\Debugbar::info($request->DeleteCarouselID);
         $Result = $this->objCarousel->delete($request->DeleteCarouselID);

        return back()->with($Result['ServerNo'], $Result['Message']);
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

  public function CarouselShow(Request $request)
  {
      $CarouselID=$request->id;

      $Result= $this->objCarousel->getCarousel($CarouselID);
      return   response()->json(['ServerNo' => $Result['ServerNo'],'Message' => $Result['Message']
                        ,'Data'=>$Result['Data']]);
  }

  public function EditItem(Request $request)
  {
      $CarouselID=$request->id;
      $Result= $this->objCarousel->getCarousel($CarouselID);
      return   response()->json(['ServerNo' => $Result['ServerNo'],'Message' => $Result['Message']
          ,'Data'=>$Result['Data']]);
  }

  /*
   *
   * */
    public function UpdateItem_(Request $request)
    {
        $Result = $this->objCarousel->PhotoUpload( $request);
        return response()->json(['ServerNo' => $Result['ServerNo']]);
    }



    public function UpdateItem(Request $request)
    {

        $Result = $this->objCarousel->save($request);


        if($Result['ServerNo']=='200')
        {
            if(!empty($request->file('image')))
            {
                $UploadResult = $this->objCarousel->PhotoUpload($request);

                if ($UploadResult['ServerNo']=='404')
                {
                    return response()->json(['ServerNo' => $UploadResult['ServerNo'],'Message' => $UploadResult['Message']],404);

                }
            }

            return response()->json(['ServerNo' => $Result['ServerNo'],
                                    'Data' => $Result['Data'],
                                    'Message'=>$Result['Message']],200);

        }else
        {
            return response()->json(['ServerNo' => $Result['ServerNo'],
                                    'Message'=>$Result['Message'],
                                    'Key'=>$Result['Key']],404);
        }

    }

    /*
     * 2017/10/09   修改該輪播是否要顯示在畫面上
     * */
    public function IsShowItem(Request $request)
    {
        $Result = $this->objCarousel->IsShow($request);
        return response()->json(['ServerNo' => $Result['ServerNo'],'Message'=>$Result['Message']]);

    }

}