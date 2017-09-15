<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//2017/06/26 新增action_photo資料表，將活動照片連結存放近來
use App\Repositories\AlbumRepository;
use App\Repositories\fellowshipRepository;


class AlbumController extends Controller
{
    private $Album;
    private $Fellowship;
    public function __construct(AlbumRepository $Album,fellowshipRepository $fellowshipRepository)
    {
        $this->Album=$Album;
        $this->Fellowship=$fellowshipRepository;
    }

    public function index()
    {}

    public function MAAlbum()
    {

        $dtfellowship = $this->Fellowship->getAll(); //fellowship::all();
        $dtAlbum = $this->Album->getAll();

        //Debug專用
        //\Debugbar::info( $dtNews );

        return view('DataMaintain.MA_Album')->with('dtfellowship',$dtfellowship)->with('dtAlbum',$dtAlbum);
    }

    public function InsertItem(Request $request)
    {
        $this->ActionPhoto->save($request);
        // \Debugbar::info($request->theme);
        $dtFellowship=$this->Fellowship->getAll();
        $dtActionPhoto=$this->ActionPhoto->getAll();
        // $dtVideos=$this->videos->getOrderByPageing(9);
        return view('DataMaintain.MA_ActionPhoto')->with('dtfellowship',$dtFellowship)->with('dtActionPhoto',$dtActionPhoto );
    }

    public function UpdateItem(Request $request)
    {
        return $this->ActionPhoto->save($request);
    }

    public function DeleteItem(Request $request)
    {
        return $this->ActionPhoto->delete($request->get('id'));
    }

    public function AddItem(Request $request)
    {   
        $Result=$this->Album->CreateAlbum($request);
        if($Result['ServerNo']=='200')
        {
            return back()->with('success', $Result['Result']);
        }else if($Result['ServerNo']=='404')
        {
             return back()->with('fails', $Result['Result']);
        }
       
    }

}