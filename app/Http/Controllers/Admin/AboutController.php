<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Models\jch_info;
use Models\fellowship;
use App\Http\Controllers\DB\DBadmin;

use App\Repositories\JchInfoRepository;

use App\Repositories\fellowshipRepository;



class AboutController extends Controller
{
   private $dtfellowship;
   private $dtjchinfo;

    public function __construct(fellowshipRepository $fellowshipRepository,JchInfoRepository $JchInfoRepository)
    {
        $this->dtfellowship=$fellowshipRepository;
        $this->dtjchinfo=$JchInfoRepository;
    }

    public function MA_About()
    {
      $jchinfo=$this->dtjchinfo->show();
      $dtfellowship = $this->dtfellowship->getAll();
      return View('DataMaintain.MA_About',compact('jchinfo','dtfellowship'));
    }

    public function UpdateItem(Request $request)
    {

        $Result = $this->dtjchinfo->save($request);

        if($Result['ServerNo']=='200')
        {   
           return back()->with('success', $Result['Result']);
            // return response()->json(['ServerNo' => '200','ResultData' => $Result['Result']]);
            // return back()->with('success', $Result['Result']);
        }else
        {
            return back()->with('fails', $Result['Result']);
             // return response()->json(['ServerNo' => '404','ResultData' => $Result['Result']]);
        }


      $jchinfo=$this->dtjchinfo->show();
      $dtfellowship = $this->dtfellowship->getAll();
      return View('DataMaintain.MA_About',compact('jchinfo','dtfellowship'));
    }

    /*
     * 2017/11/18   關於建成按下修改控制項會執行
     * */
    public function EditItem(Request $request)
    {
        $Result= $this->dtjchinfo->save($request);
        if($Result['ServerNo']=='200')
        {
            return response ()->json (['ServerNo'=>'200','ResultData' => $Result['Result'] ,'data'=>$Result['data']]);
        }
        else
        {
            // \Debugbar::info($Result['Result'][0]);
            return response ()->json (['ServerNo'=>'404','ResultData'=> $Result['Result']]);
        }

    }

  // public function show()
  // {
 //    //因為教會資訊只會有一筆資料，所以就直接查詢id為1的那筆資料列
  //   $dtJch_info =jch_info::all()->where('id','1');
  //  //  $dtVerse=verse::all()->where('id','1');
  //  //  $dtControl=dtControl::where('BLADE_NAME','index');
 //     $test = new DBadmin($dtJch_info);
 //     //$Rowtest= $test->getTableItem(0,'CNAME');
 //     $arrayName = array(array('id' , "=","1"),array('name' , "=","test"));
 //     $test->setWhere($arrayName);
 //         //下面將教會資訊從資料庫提取出來，並且放到變數當中，最後再放到陣列中，並且帶到view當中
 //        foreach($dtJch_info as $jch_info)
 //        {
 //          $CNAME=$jch_info->cname;//$test->getTableWhere();
 //          $ENAME=$jch_info->ename;
 //          $ADDRESS=$jch_info->address;
 //          $PHONE=$jch_info->phone;
 //          $EMAIL=$jch_info->email;
 //          $UNIFORM=$jch_info->uniform_number;
 //          $FEX=$jch_info->fex;
 //        }
 //        //放入陣列當中
 //        $JCH_INFO= array('CNAME'=>$CNAME,'ENAME'=>$ENAME,'ADDRESS'=>$ADDRESS,'PHONE'=>$PHONE,'EMAIL'=>$EMAIL,
 //                        'UNIFORM'=>$UNIFORM,'FEX'=>$FEX);
 //         $dtfellowship =fellowship::all();
  //  return View('about.about')->with('JCH_INFO',$JCH_INFO)->with('dtfellowship',$dtfellowship);
  // }
}
