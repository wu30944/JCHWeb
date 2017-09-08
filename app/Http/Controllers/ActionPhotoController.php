<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//2017/06/26 新增action_photo資料表，將活動照片連結存放近來
use App\Repositories\ActionPhotosRepository;
use App\Repositories\fellowshipRepository;


class ActionPhotoController extends Controller
{	
	private $ActionPhoto;
	private $Fellowship;
    public function __construct(ActionPhotosRepository $ActionPhotosRepository,fellowshipRepository $fellowshipRepository)
    {
        $this->ActionPhoto=$ActionPhotosRepository;
        $this->Fellowship=$fellowshipRepository;
    }

	public function MA_ActionPhoto()
	{	
		   // $dtNews = $this->dtNews->getAll();

        $dtfellowship = $this->Fellowship->getAll(); //fellowship::all();
        $dtActionPhoto = $this->ActionPhoto->getAll();
          
          //Debug專用
         //\Debugbar::info( $dtNews );

		return view('DataMaintain.MA_ActionPhoto')->with('dtfellowship',$dtfellowship)->with('dtActionPhoto',$dtActionPhoto);
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
}