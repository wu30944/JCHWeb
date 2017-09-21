<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//2017/06/26 新增action_photo資料表，將活動照片連結存放近來
use App\Repositories\ActionPhotosRepository;


class ActionPhotoController extends Controller
{	
	 private $ActionPhoto;

  public function __construct(ActionPhotosRepository $ActionPhotosRepository)
    {
        $this->ActionPhoto=$ActionPhotosRepository;
    }

	public function MA_ActionPhoto()
	{	
		   // $dtNews = $this->dtNews->getAll();
        $dtActionPhoto = $this->ActionPhoto->getAll();
          
          //Debug專用
         //\Debugbar::info( $dtNews );

		return view('DataMaintain.MA_ActionPhoto')->with('dtActionPhoto',$dtActionPhoto);
	}

  public function InsertItem(Request $request)
  {
       $this->ActionPhoto->save($request);

        $dtActionPhoto=$this->ActionPhoto->getAll();
        // $dtVideos=$this->videos->getOrderByPageing(9);
        return view('DataMaintain.MA_ActionPhoto')->with('dtActionPhoto',$dtActionPhoto );
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