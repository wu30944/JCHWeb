<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\dtControlRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\AlbumDRepository;

use DB;
use App\CoreClass\AlbumClass;

use Response;

class AlbumController extends Controller
{

    private $objControl;
    private $objAlbum;
    private $objAlbumD;
    private $AlbumClass;

    public function __construct(AlbumRepository $AlbumRepository,
                                dtControlRepository $VersesRepository,
                                AlbumDRepository $AlbumDRepository)
    {
        $this->objControl = $VersesRepository;
        $this->objAlbum = $AlbumRepository;
        $this->objAlbumD = $AlbumDRepository;
        $this->AlbumClass = new AlbumClass();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dtAlbum = $this->objAlbum->getOrderByPageing(10);
        return view('album.admin.index')->with('Album',$dtAlbum);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateItem(Request $request)
    {
        //

        try {
            DB::connection()->getPdo()->beginTransaction();

//            $AlbumClass = new AlbumClass();
//            $AlbumClass->CreateAlbum($request->AlbumName);
            $this->AlbumClass->CreateAlbum($request->AlbumName);

            $Result=$this->objAlbum->CreateAlbum($request);

            DB::connection()->getPdo()->commit();

            return back()->with('success', $Result['Result']);

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EditItem($strAlbumName)
    {
        $strAlbumId = $this->objAlbum->GetAlbumId($strAlbumName);
        $Images = $this->objAlbumD->GetAlbumPhoto($strAlbumId);

        return view('album.admin.edit')->with('AlbumName',$strAlbumName)->with('Images',$Images);
    }

    public function LoadOriginItem(Request $request){
        \Debugbar::info($request);
//        $strAlbumId=$this->objAlbum->GetAlbumId($strAlbumName);
//        $strImages=$this->objAlbumD->GetAlbumInfo($strAlbumId);
//        $data=$this->AlbumClass->GetAlbumContent($strImages);
        return Response::json(array('files'=>NULL));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DestoryAlbum(Request $request)
    {
        //
        try {
            $id=$request->DeleteAlbumID;
            DB::connection()->getPdo()->beginTransaction();


            $strAlbumName=$this->objAlbum->GetAlbumName($id);
            $this->objAlbum->delete($id);
            $this->objAlbumD->DeleteAlbum($id);

            \Debugbar::info($strAlbumName);
            $this->AlbumClass->SetAlbumName($strAlbumName);
            $this->AlbumClass->DeleteAlbum();

            DB::connection()->getPdo()->commit();

            return back()->with('success', trans('message.DeleteSuccess'));

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    public function DestoryPhoto(Request $request)
    {
        //
        try {
            $DeleteAlbumId=$request->DeletePhotoId;
            DB::connection()->getPdo()->beginTransaction();

            $DeletePhotoVirtualPath=$this->objAlbumD->GetPhotoVirtualPath($DeleteAlbumId);

            \Debugbar::info($DeletePhotoVirtualPath);
            $this->AlbumClass->DeleteAlbumImage($DeletePhotoVirtualPath);
            $Result = $this->objAlbumD->DeletePhoto($DeleteAlbumId);
            DB::connection()->getPdo()->commit();
            return response ()->json (['Message'=>$Result['Message']],200);
            //return back()->with('success', trans('message.DeleteSuccess'));

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    /*
     * 上傳照片會跑來此function
     * 他會先去呼叫上傳照片的Class
     * 要先初始該類別，必須傳入相簿名稱、並且給予要上傳的照片
     * 當照片確認放入實體位置後，類別會回傳照片資訊回來，
     * 最後，再將這些相關資訊存入album_d這個table
     * */
    public function Upload(Request $request){
        try{
            // Path for guest upload
            DB::connection()->getPdo()->beginTransaction();
            $files=$request;
            $this->AlbumClass->SetAlbumName($request->AlbumName);
            $this->AlbumClass->SetFiles($files);
            $strAlbumId = $this->objAlbum->GetAlbumId($request->AlbumName);
            $data=$this->AlbumClass->UploadAlbum($strAlbumId);
            DB::connection()->getPdo()->commit();

            return Response::json(array('files'=>$data));

        }catch (Exception $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json (['Message'=>$e->getMessage()],403);
        }

    }

}
