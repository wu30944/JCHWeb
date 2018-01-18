<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//2017/06/26 新增action_photo資料表，將活動照片連結存放近來
use App\Repositories\AlbumDRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\fellowshipRepository;


class AlbumController extends Controller
{
    private $objFellowship;
    public $objAlbum;
    public $objAlbumD;

    public function __construct(fellowshipRepository $fellowshipRepository,
                                AlbumRepository $AlbumRepository,
                                AlbumDRepository $AlbumDRepository)
    {
        $this->objFellowship=$fellowshipRepository;
        $this->objAlbumD =  $AlbumDRepository;
        $this->objAlbum = $AlbumRepository;
    }

    public function Index(){

        $dtFellowship=$this->objFellowship->getAll();

        /*20180115 撈出每本相簿中N張相片*/
        $dtAlbum = $this->objAlbum->getAlbum();
//        $objAlbumSet = $this->objAlbumD->GetAlbumPhotoPutInArray($dtAlbum,2);

        \Debugbar::info(count($this->objAlbum->GetAlbumInfo()));

        $objAlbumSet = $this->objAlbum->GetAlbumInfo(3);

        return view('album.public.index')
            ->with('dtfellowship',$dtFellowship)
            ->with('objAlbumSet',$objAlbumSet)
            ->with('dtAlbum',$dtAlbum);
    }

    public function IndexD($Id){
        $dtAlbum = $this->objAlbumD->GetAlbumDContent($Id);
        $AlbumName = $this->objAlbum->GetAlbumName($Id);
        return view('album.public.index_d')
               ->with('dtAlbum',$dtAlbum)
               ->with('AlbumName',$AlbumName);

    }

    public function MAAlbum()
    {

        $dtfellowship = $this->objFellowship->getAll(); //objFellowship::all();
        $dtAlbum = $this->objAlbum->getAll();

        //Debug專用
        //\Debugbar::info( $dtNews );

        return view('DataMaintain.MA_Album')->with('dtfellowship',$dtfellowship)->with('dtAlbum',$dtAlbum);
    }

    public function InsertItem(Request $request)
    {
        $this->ActionPhoto->save($request);
        // \Debugbar::info($request->theme);
        $dtFellowship=$this->objFellowship->getAll();
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
        $Result=$this->objAlbum->CreateAlbum($request);
        if($Result['ServerNo']=='200')
        {
            return back()->with('success', $Result['Result']);
        }else if($Result['ServerNo']=='404')
        {
             return back()->with('fails', $Result['Result']);
        }
       
    }

}