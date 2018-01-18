<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Models\album_d;
use Validator;
use Response;
use DB;
use StdClass;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class AlbumDRepository
{
    private $dtAlbumnD;

    public function __construct(album_d $albumn_d)
    {
        $this->dtAlbumnD=$albumn_d;
    }

    public function getAll()
    {
        return $this->dtAlbumD->all();
    }

    /*
     * 取出目前有的相簿
     * */
    public function GetAlbumInfo($id)
    {
        if($id){
            $images = $this->dtAlbumnD->where('album_id','=',$id)->get();//DB::table('images')->where('product',$id)->get();
            \Debugbar::info(count($images));
            if(count($images)>0){
                foreach ($images as $image) {
                    $info = new StdClass;
                    $info->id = $image->id;
                    $info->name = $image->photo_name;
                    $info->url = $image->photo_path;
                    $data[] = $info;
                }

                return $data;
            }
            else return false;
        }
        else return false;

    }

    public function GetAlbumPhoto($id){

        if($id){
            return  $this->dtAlbumnD->where('album_id','=',$id)->paginate(9);//DB::table('images')->where('product',$id)->get();
        }
        else return false;
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
                //    array ('errors' => $validator->messages()->all() ));
                return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
                // return response()->json(['0' => '404','Result' =>  $validator->messages()->all()]);
            }
            else {
                DB::connection()->getPdo()->beginTransaction();
                $data = new Album();

                $data->album_name = $request->AlbumName;
                $data->isvisible = 'Y';
                $data->position = $request->Position;
                $data->save ();
                DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'200','Result' =>'建立成功！']);
            }

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
        }

        // return response ()->json ( ['0'=>'200','Result'=>'儲存成功！' ]);
    }

    public static function Save($strAlbumId,$Data)
    {
        foreach($Data as $item){
            $data = new album_d;
            $data->album_id = $strAlbumId;
            $data->photo_name = $item->name;
            $data->photo_path = $item->url;
            $data->photo_thumb_path = $item->thumbnailUrl;
            $data->photo_virtual_path = $item->VirtualPath;
            $data->save();
        }
    }


    public function DeletePhoto($id)
    {
        $this->dtAlbumnD->whereIn('id',$id)->delete();
        return collect(['ServerNo'=>'200','Message'=> trans('message.DeleteSuccess')]);
    }

    public function DeleteAlbum($id)
    {
        $this->dtAlbumnD->where('album_id','=',$id)->delete();
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
        // return \Response::json([
        //     'success' => true,
        //     'name' => $filename,
        // ]);

    }

    public function getOrderByPageing($num)
    {
        return $this->dtStaff->orderBy('cod_id','desc')->paginate($num);
    }

    public function GetPhotoVirtualPath($PhotoId){

        $dtAlbumD =  $this->dtAlbumnD->whereIn('id',$PhotoId)->get();
        foreach($dtAlbumD as $item){
            $data[]=$item->photo_virtual_path;
        }
        return $data;
    }

    public function GetAlbumPhotoPutInArray($dtAlbum,$Number=NULL){

        if(isset($dtAlbum) && $Number>0) {

            foreach ($dtAlbum as $item) {
                $Return[] = $this->dtAlbumnD->where('album_id','=',$item->id)->take($Number)->get();
            }
        }else if(isset($dtAlbum) && $Number==NULL){

            foreach ($dtAlbum as $item) {
                $Return[] = $this->dtAlbumnD->where('album_id','=',$item->id)->get();
            }
        }
        return $Return;
    }

    public function GetAlbumDContent($strAlbumId){
        $Result=DB::select('select a.id,a.album_name,b.photo_name,b.photo_path 
                                        from album a 
                                        inner join album_d b 
                                        on a.id=b.album_id
                                        and b.album_id=?
                                        ', [$strAlbumId]);
        $page = Paginator::resolveCurrentPage("page");
        $perPage = 9; //實際每頁筆數
        $offset = ($page * $perPage) - $perPage;

        $data = new LengthAwarePaginator(array_slice($Result, $offset, $perPage, true), count($Result), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);


        return $data;
    }

}