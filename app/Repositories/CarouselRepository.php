<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\carousel;
    use Validator;
    use Response;
    use DB;

    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;


    class CarouselRepository
    {
	  	private $dtCarousel;

        public function __construct(carousel $data)
        {
            $this->dtCarousel=$data;
        }

        public function getAll()
        {
        	return $this->dtCarousel->all();
        }

        /*
         * 2017/10/09  取出要顯示在輪播畫面上的圖片資訊
         * */
        public function getIsShowCarousel()
        {
            $ToDay = date("Y-m-d");
            return $this->dtCarousel->where('is_show','=','1')
                ->Where('show_date','<=',$ToDay)->get()
                ->Where('photo_path','<>','');
        }

        /*
         * 2017/09/22   新增輪播圖片
         * */
        public function save(Request $request)
        {
            $user = auth('admin')->user()->name;
            try {
                    $rules = array (
                        'photo_name'=> 'required',
                        'show_date'=>'required',
                    );
                    $messages = ['photo_name.required' => '輪播照片名稱不能為空'
                                 ,'show_date.required'=>'顯示日期欄位不能為空'];

                    $validator = Validator::make ( $request->all(), $rules,$messages );

                    if ($validator->fails ()){
                         // return Response::json (
                         //    array ('errors' => $validator->messages()->all() ));
                          return  collect(['ServerNo'=>'404','Message' =>  $validator->messages()->all()]);
                    }
                    else {

                        DB::connection()->getPdo()->beginTransaction();

                        if($request->id==NULL || $request->id=="")
                        {

                            $data = new carousel();

                            $data->photo_name = $request->photo_name;
                            $data->show_date = $request->show_date;
                            $data->is_show = 0;
                            $data->photo_path='';
                            $data->created_user=$user;
                            $data->modify_user=$user;
                            \Debugbar::info('test1');
                            $data->save ();


                        }else{
                            $data = $this->dtCarousel->find($request->id);

                            $data->photo_name = $request->photo_name;
                            $data->show_date = $request->show_date;
                            $data->is_show = 0;
                            $data->created_user=$user;
                            $data->modify_user=$user;

                            $data->save ();
                        }
                        DB::connection()->getPdo()->commit();

                        return  collect(['ServerNo'=>'200','Message' =>'儲存成功！','id'=>$data->id]);
                    }
                } catch (\PDOException $e) {
                DB::connection()->getPdo()->rollBack();
            }
        }

        public function delete($id)
        {
            try {
                DB::connection()->getPdo()->beginTransaction();
                $this->dtCarousel->find($id)->delete();
                DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'success','Message' =>'刪除成功！']);

            } catch (\PDOException $e) {
                DB::connection()->getPdo()->rollBack();
                return  collect(['ServerNo'=>'fails','Message' =>'刪除失敗！']);
            }
        }

        /*
            撈出長老
        */
        public function getElder()
        {
            $strType='duty';
            $strDepart='depart';
            $strStaff='2';
            return  $dtNews=DB::select('select a.id,a.name,a.image_path,a.sdate
                                ,a.edate,b.cod_val,c.cod_val as depart
                                 from staffs a
                                 join codtbld b
                                 on b.cod_type= ?
                                 and b.cod_id=a.cod_id 
                                 join codtbld c 
                                 on c.cod_type= ?
                                 and c.cod_id=a.depart_id
                                 where a.cod_id= ?
                                 and a.edate >= CURDATE()', [$strType,$strDepart,$strStaff]);
        }

        public function getOrderByPageing($num)
        {
             return $this->dtCarousel->orderBy('show_date','desc')->paginate($num);
        }

        /*
         * 2017/09/28   新增 職務查詢
         * */
        public function query(Request $request)
        {
            // \Debugbar::info($request->SearchSpeaker);
            $empty='';
            $query = DB::select( DB::raw('select * from  staffs
                                                where (name = ? or ? = ?)
                                                and (cod_id= ? or ?= ?)
                                                and (depart_id= ? or ? = ?)
                                                and (sdate between ? and ?)' )
                ,[$request->SearchName,
                    $request->SearchName,
                    $empty,
                    $request->SearchStaff,
                    $request->SearchStaff,
                    $empty,
                    $request->SearchDepart,
                    $request->SearchDepart,
                    $empty,
                    $request->SearchSDate,
                    $request->SearchEDate]);

            $page = Paginator::resolveCurrentPage("page");
            $perPage = 9; //實際每頁筆數
            $offset = ($page * $perPage) - $perPage;

            $data = new LengthAwarePaginator(array_slice($query, $offset, $perPage, true), count($query), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);

            return $data;
        }

        /*
         * 2017/10/04   輸入資料ID，取得輪播圖片資訊
         * */
        public function getCarousel($CarouselID)
        {
            $data = $this->dtCarousel->where ('id','=',$CarouselID)->get();
            $ServerNo="200";
            $Message="";
            if(count($data)==0)
            {
                $Message="資料庫有誤，請洽工程師";
                $ServerNo  ="404";
            }
            return  collect(['ServerNo'=>$ServerNo,'Message'=>$Message,'Data'=>$data]);
        }

        /*
         * 2017/10/08   上傳照片function
         * */
        public function PhotoUpload(Request $request)
        {

            $file = $request->file('image');


            //必須是image的驗證
            $input = array('image' => $file);
            $rules = array(
                'image' => 'image'
            );

            $validator = \Validator::make($input, $rules);
            if ( $validator->fails() ) {
                return collect([
                    'ServerNo'=>'404',
                    'Message' => $validator->getMessageBag()->toArray(),
                    'Data'=>''
                ]);
            }else{

                $destinationPath = public_path().config('app.carousel_photo_path');


                if (!is_dir($destinationPath))
                {
                    mkdir($destinationPath);
                }

                //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
                $filename = $request->get('id').'.jpg';

                $data = carousel::find($request->get('id'));
                $data->photo_path = config('app.carousel_photo_path').'/'.$filename;
                $data->save();


                //  移動檔案
                if(!$file->move($destinationPath,$filename)){
                    return collect(['ServerNo' => '404','Message' => '圖片儲存失敗','Data'=>""]);
                }

                return  collect(['ServerNo'=>'200','Message'=>'圖片儲存成功','Data'=>$data->photo_path]);
//                return collect(['ServerNo' => '200','Message' => '圖片儲存成功','Data'=> $data]);
            }

        }

        public function IsShow(Request $request)
        {
            \Debugbar::info($request->is_show);

            try{
                DB::connection()->getPdo()->beginTransaction();

                $data = $this->dtCarousel->find($request->id);
                $data->is_show = $request->is_show;
                $data->save ();

                DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'200','Message' =>'更改成功！']);
            }catch (\PDOException $e)
            {
                DB::connection()->getPdo()->rollBack();
                return  collect(['ServerNo'=>'404','Message' =>'更改失敗！']);
            }
        }

    }