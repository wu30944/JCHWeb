<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Models\album;
use Models\album_d;
use Validator;
use Response;
use DB;


class AlbumRepository
{
    private $dtAlbum;
    private $dtAlbumnD;

    public function __construct(album $data,album_d $albumn_d)
    {
        $this->dtAlbum=$data;
        $this->dtAlbumnD=$albumn_d;
    }

    public function getAll()
    {
        return $this->dtAlbum->all();
    }

    /*
     * 取出目前有的相簿
     * */
    public function getAlbum()
    {
        return $this->dtAlbum->where('isvisible')->get();
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

    public function save(Request $request)
    {

        $rules = array (
            'name'=> 'required',
            'duty'=>'not_in:choice',
            'sdate'=>'required',
            'edate'=>'required'
        );
        $messages = ['name.required' => '姓名欄位不能空白'
            ,'duty.not_in'=>'請選擇職務'];
        // \Debugbar::info($request->name);
        // \Debugbar::info($request->duty);
        // \Debugbar::info($request->sdate);
        // \Debugbar::info($request->edate);
        $validator = Validator::make ( $request->all(), $rules,$messages );
        \Debugbar::info($request->duty);
        if ($validator->fails ()){
            // return Response::json (
            //    array ('errors' => $validator->messages()->all() ));
            return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
            // return response()->json(['0' => '404','Result' =>  $validator->messages()->all()]);
        }
        else {
            // \Debugbar::info('2');
            if($request->id==NULL)
            {
                $data = new staff();

                $data->name = $request->name;
                $data->cod_id = $request->duty;
                $data->sdate = $request->sdate;
                $data->edate = $request->edate;
                $data->save ();
                $this->create_staff_d($data->id,$request->name,$request->duty);

            }else{
                $data = $this->dtStaff->find($request->id);

                $data->name = $request->name;
                $data->cod_id = $request->duty;
                $data->sdate = $request->sdate;
                $data->edate = $request->edate;
                $data->save ();

                /*
                    20170831. 為了要同步staff與 staffs_d兩個table的人員資料
                    所以在這裡也必須要儲存staffs_d中的cod_id欄位資料，不然當修改
                    職務時，就會發生錯誤
                */
                $staffd_id = $this->dtAlbum->where('staff_id','=',$request->id)->pluck('id');
                // \Debugbar::info(count($staffd_id));
                if(count($staffd_id)>0)
                {
                    $data_d=$this->dtAlbum->find($staffd_id);
                    $data_d->cod_id = $request->duty;
                    $data_d->save ();
                }


            }

            // Session::flash('message', 'Successfully updated nerd!');
            // return response ()->json ( $data );
            return  collect(['ServerNo'=>'200','Result' =>'儲存成功！','id'=>$data->id]);
            // return response ()->json ( ['0'=>'200','Result'=>'儲存成功！' ]);
        }
    }

    public function delete($id)
    {
        // \Debugbar::info($id);
        if( $this->dtStaff->find($id)->delete()
            && $this->dtAlbum->where('staff_id','=',$id)->delete())
        {
            return  collect(['ServerNo'=>'success','Result' =>'刪除成功！']);
        }else{
            return  collect(['ServerNo'=>'fails','Result' =>'刪除失敗！']);
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
        // return \Response::json([
        //     'success' => true,
        //     'name' => $filename,
        // ]);

    }

    public function getOrderByPageing($num)
    {
        return $this->dtStaff->orderBy('cod_id','desc')->paginate($num);
    }
}