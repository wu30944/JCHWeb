<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\dtControlRepository;
use App\Repositories\VersesRepository;

class VersesController extends Controller
{
    private $objControl;
    private $objVerses;

    public function __construct(dtControlRepository $dtControlRepository,VersesRepository $VersesRepository)
    {
        $this->objControl = $dtControlRepository;
        $this->objVerses = $VersesRepository;
    }

//    public function MAVerses()
//    {
//       $dtControl = $this->objControl->getTableSetting('MA_Verses');
//       $dtVerses = $this->objVerses->getAll();
//        return view('DataMaintain.MA_Verses')->with('dtVerses',$dtVerses)
//            ->with('dtControl',$dtControl);
//    }

    /*
        編輯聚會資訊的fun
    */
    public function editItem(Request $request) {

        \Debugbar::info($request->id);
        $Result=$this->objVerses->save($request);


        if($Result['ServerNo']=='200')
        {
            return response ()->json ( ['ServerNo'=>'200','ResultData'=> $Result['Result'],'data'=>$Result['data']]);
//            return back()->with('success', $Result['Result']);
        }else
        {
            return response ()->json ( ['ServerNo'=>'404','ResultData'=> $Result['Result'][0]]);
//            return back()->with('fails', $Result['Result'][0]);
        }
    }

}
