<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Models\album;
use Models\album_d;
use Validator;
use Response;
use DB;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class AlbumRepository
{
    private $dtAlbum;

    public function __construct(album $data)
    {
        $this->dtAlbum=$data;
    }

    public function getAll()
    {
        return $this->dtAlbum->all();
    }

    /*
     * 取出目前有的相簿，且該相簿是有在使用的
     * */
    public function getAlbum($strNumber = NULL)
    {
        \Debugbar::info($strNumber);
        if($strNumber== NULL){
            return $this->dtAlbum->where('isvisible','=','Y')->get();
        }else{
            return $this->dtAlbum->where('isvisible','=','Y')->take($strNumber)->get();
        }

    }


    /*
            2018/01/16. 取出相簿資訊
    */
    public function GetAlbumInfo($Number=2)
    {
        $dtAlbum = $this->dtAlbum->where('isvisible','=','Y')->get();

        foreach($dtAlbum as $item){
            $Result[]=DB::select('select a.id,a.album_name,b.photo_name,b.photo_path 
                                        from album a 
                                        inner join album_d b 
                                        on a.id=b.album_id
                                        and b.album_id=?
                                        and a.album_name=?
                                        LIMIT ?', [$item->id,$item->album_name,$Number]);
        }

        $page = Paginator::resolveCurrentPage("page");
        $perPage = 9; //實際每頁筆數
        $offset = ($page * $perPage) - $perPage;

        $data = new LengthAwarePaginator(array_slice($Result, $offset, $perPage, true), count($Result), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);


        return $data;

    }


    public function CreateAlbum(Request $request)
    {
      try{
            $rules = array (
                         'AlbumName'=> 'required'
                          );
            $messages = ['AlbumName.required' => '相簿名稱為必輸欄位'];

             $validator = Validator::make ( $request->all(), $rules,$messages );
       
        if ($validator->fails ()){
            // return Response::json (

            return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
        }
        else {
                 //DB::connection()->getPdo()->beginTransaction();
                $data = new Album();

                $data->album_name = $request->AlbumName;
                $data->isvisible = 'Y';
                $data->position = '';
                $data->save ();
                 //DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'200','Result' =>'建立成功！']);
            }
                    
        }catch (\PDOException $e)
        {
            //DB::connection()->getPdo()->rollBack();
        }

    }


    public function delete($id)
    {
        // \Debugbar::info($id);
        if( $this->dtAlbum->find($id)->delete())
        {
            return  collect(['ServerNo'=>'200','Result' =>'刪除成功！']);
        }else{
            return  collect(['ServerNo'=>'404','Result' =>'刪除失敗！']);
        }

    }


    /*
    上傳圖片的function
    2017/05/13
    */
    public function PhotoUpload(Request $request,$id)
    {
        $file = $request->file('image');
        // $file = $request->file('image');

        $catalog = '/staff';

        //必須是image的驗證
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );

        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            // return \Response::json([
            //     'success' => false,
            //     'errors' => $validator->getMessageBag()->toArray()
            // ]);
            return collect(['ServerNo'=>'404','Result' =>$validator->getMessageBag()->toArray()]);
        }else{

            $destinationPath = public_path().env('PHOTO_PATH').$catalog;


            if (!is_dir($destinationPath))
            {
                mkdir($destinationPath);
            }

            //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
            $filename = $id.'.jpg';//$file->getClientOriginalName();

            // $dataID=$this->dtStaff->where('id','=',$id)->where('cod_id','=',$request->duty)->pluck('id');
            $data = staff::find($id);
            \Debugbar::info($filename);
            $data->image_path = env('PHOTO_PATH').$catalog.'/'.$filename;
            $data->save();


            //  移動檔案
            if(!$file->move($destinationPath,$filename)){
                // return response()->json(['ServerNo' => '404','Result' => '圖片儲存失敗！']);
                return collect(['ServerNo'=>'404','Result' => '圖片儲存失敗！']);
            }

            return collect(['ServerNo'=>'200','Result'=>'照片上傳成功！']);
            // return response()->json(['ServerNo' => '200','Result' => '照片上傳成功！']);
        }
    }

    public function getOrderByPageing($num)
    {
        return $this->dtAlbum->orderBy('created_at','desc')->paginate($num);
    }

    public function GetAlbumName($id){
        return $this->dtAlbum->where('id','=',$id)->value('album_name');
    }

    public function GetAlbumId($strAlbumName){
        return $this->dtAlbum->where('album_name','=',$strAlbumName)->value('id');
    }



}