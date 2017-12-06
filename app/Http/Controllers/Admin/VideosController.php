<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Models\dtControl;
use Input;
use DB;

use App\Http\Controllers\Controller;
use App\Repositories\MoreYoutubeRepository;
use App\Repositories\fellowshipRepository;
use App\Repositories\codtbldRepository;

class VideosController extends Controller
{
	private $videos;
	private $fellowship;
    private $codtbld;

    public function __construct(fellowshipRepository $fellowshipRepository,MoreYoutubeRepository $MoreYoutubeRepository,codtbldRepository $codtbldRepository)
    {
        $this->fellowship=$fellowshipRepository;
        $this->videos=$MoreYoutubeRepository;
        $this->codtbld=$codtbldRepository;
        // $this->categories = Category::where('parent_id', '=', 0)->get();
    }

    public function MA_MoreYoutube()
    {   
        $dtVideoType = $this->codtbld->getWhere('video');
        $item=collect([]);
        // $item->push('新增年份');
        foreach ($dtVideoType as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->cod_id]=$key->cod_val;
        }
        $ItemAll=$item->all();


    	$dtVideos=$this->videos->Testquery('2'); //$this->videos->getOrderByPageing(9);
    	 //Debug專用

    	$dtFellowship=$this->fellowship->getAll();
    	return view('DataMaintain.MA_SundayVideo')->with('dtfellowship',$dtFellowship)->with('dtvideos',$dtVideos )->with('ItemAll',$ItemAll);
    }

    public function DeleteItem(Request $request)
    {
        return $this->videos->delete($request->id);
    }

    public function EditItem(Request $request)
    {
         // \Debugbar::info($request->id);
        // \Debugbar::info($request->video_type);
        $Result= $this->videos->save($request);
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

    public function InsertItem(Request $request)
    {
         $Result=$this->videos->save($request);
         // \Debugbar::info($request->theme);
        
        if($Result['ServerNo']=='200')
        {  
            return back()->with('success', $Result['Result']);
        }else
        {
            return back()->with('fails', $Result['Result'][0]);
        }
    }

    public function show($video_type)
    {

        $dtmore_youtube=$this->videos->getVideoOrderByPageing(9,$video_type);
         //Debug專用
         \Debugbar::info( $dtmore_youtube );

        $dtFellowship=$this->fellowship->getAll();
        return view('more.more_youtube')->with('dtfellowship',$dtFellowship)->with('dtmore_youtube',$dtmore_youtube );
    }

    public function Search(Request $request)
    {
        $dtVideos=$this->videos->query($request);
        \Debugbar::info($dtVideos);
        $dtFellowship=$this->fellowship->getAll();
        $dtVideoType = $this->codtbld->getWhere('video');
         $item=collect([]);
        // $item->push('新增年份');
        foreach ($dtVideoType as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->cod_id]=$key->cod_val;
        }
        $ItemAll=$item->all();

        return view('DataMaintain.MA_SundayVideo')->with('dtfellowship',$dtFellowship)->with('dtvideos',$dtVideos )->with('ItemAll',$ItemAll)->with('request',$request);
        //response()->json(['ServerNo'=>'200','ResultData'=>$this->videos->query($request)]);
    }

}
