<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\fellowship;
    use Models\fellowship_d;
    use Models\staffs_d;
    use Validator;
    use Response;
    use DB;
    use Storage;


    class FellowshipRepository
    {
	  	private $dtFellowship;
	  	private $dtFellowship_d;

        public function __construct(fellowship $fellowship,fellowship_d $fellowship_d)
        {
            $this->dtFellowship=$fellowship;
            $this->dtFellowship_d=$fellowship_d;
        }

        public function getAll()
        {
        	return $this->dtFellowship->all();
        }

        public function save_d(Request $request)
        {
            $rules = array (
                'introduction_title'=> 'required',
                'introduction_content'=> 'required',
                'page_one_title'=>'required',
                'page_two_title'=>'required',
                'page_three_title'=>'required',
                'page_four_title'=>'required',
                'page_one_content'=>'required',
                'page_two_content'=>'required',
                'page_three_content'=>'required',
                'page_four_content'=>'required'

            );

            $validator = Validator::make ( Input::all (), $rules );
            if ($validator->fails ()){
                return Response::json (
                    array ('errors' => $validator->messages()->all() ));
            }
            else {
                \Debugbar::info($request);
                $data = fellowship_d::find($request->id);
                $data->introduction_title = $request->introduction_title;
                $data->introduction_content = $request->introduction_content;
                $data->page_one_title = $request->page_one_title;
                $data->page_two_title = $request->page_two_title;
                $data->page_three_title = $request->page_three_title;
                $data->page_four_title = $request->page_four_title;
                $data->page_one_content = $request->page_one_content;
                $data->page_two_content = $request->page_two_content;
                $data->page_three_content = $request->page_three_content;
                $data->page_four_content = $request->page_four_content;
                $data->save ();

                // Session::flash('message', 'Successfully updated nerd!');
                return response ()->json ( $data );


            }


            return  collect(['ServerNo'=>'200','Result' =>'儲存成功！']);
        }

        /*
         * 當建立團契時，就同步建立聚會時間
         * */
        public function CreateMeetingInfo($fellowship_id,$name)
        {
            $data = new \Models\MeetingInfo;
            $data->fellowship_id=$fellowship_id;
            $data->name=$name;
            $data->save ();

        }


        public function save(Request $request)
        {

            $rules = array (
                'fellowship_name'=> 'required'
            );
            $messages = ['fellowship_name.required' => '團契名稱必須要輸入'];

            $validator = Validator::make ( $request->all(), $rules,$messages );

            if ($validator->fails ()){       

                  return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
                  // return response()->json(['0' => '404','Result' =>  $validator->messages()->all()]);
            }
            else {
                try{
                    DB::connection()->getPdo()->beginTransaction();

                    $objFellowship = new fellowship;
                    $objFellowship->NAME = $request->fellowship_name;
                    $objFellowship->save ();

                    $objFellowshipD = new fellowship_d;
                    $objFellowshipD->name = $request->fellowship_name;
                    $objFellowshipD->fellowship_id=$objFellowship->id;
                    $objFellowshipD->introduction_title = $request->fellowship_name;
                    $objFellowshipD->save();

                    $this->CreateMeetingInfo($objFellowship->id,$objFellowship->NAME);

                    DB::connection()->getPdo()->commit();
                    return  collect(['ServerNo'=>'200','Result' =>'建立成功！']);
                }catch (\PDOException $e)
                {
                    DB::connection()->getPdo()->rollBack();
                }

            }

        }

        public function delete($id)
        {
            try {

                // \Debugbar::info($id);
                $objMeegingInfo = new \Models\MeetingInfo;
                if (count($this->dtFellowship->find($id)) > 0
                    && count($objMeegingInfo::where('fellowship_id', '=', $id)) > 0) {
                    DB::connection()->getPdo()->beginTransaction();

                    $this->dtFellowship->find($id)->delete();
                    $objMeegingInfo::where('fellowship_id', '=', $id)->delete();
                    /*\Debugbar::info(count($this->dtFellowship->find($id)));
                    \Debugbar::info(count($objMeegingInfo::where('fellowship_id','=',$id)));*/
                    if (count($this->dtFellowship_d->where('fellowship_id', '=', $id)) > 0) {

                        /*
                        * 團契照片名稱都是該資料烈的id，所以要取出刪除照片名稱就是取出ＩＤ
                        * 刪除照片需要先做，如果先刪除fellowship_d的資料，就會取不到fellowship_d中的id資料
                        * */
                        $PhotoName=$this->dtFellowship_d->where('fellowship_id','=',$id)->first();
                        $this->DeletePhoto($PhotoName->id.'.jpg');

//                    \Debugbar::info(count($this->dtFellowship_d->where('fellowship_id','=',$id)));
                        $this->dtFellowship_d->where('fellowship_id', '=', $id)->delete();

                    }
                   DB::connection()->getPdo()->commit();
                    return collect(['ServerNo' => '200', 'Result' => '刪除成功！']);
                } else {
                    return collect(['ServerNo' => '404', 'Result' => '刪除失敗！']);
                }
            } catch (\PDOException $e) {
                DB::connection()->getPdo()->rollBack();
            }
        }

        public function DeletePhoto($FileName)
        {
            $FilePath=config('app.fellowship_photo_path').'/'.$FileName;

            $destinationPath=public_path().Storage::url($FilePath);
            if(file_exists($destinationPath)){
                unlink($destinationPath);//將檔案刪除
            }else{
                echo 'Not Found Photo';
            }
        }

        /*
        上傳圖片的function
        2017/05/13 
        */
        public function PhotoUpload(Request $request)
        {   
            $file = $request->file('image');
             // $file = $request->file('image');

            $id=$request->id;

            //$catalog = '/staff';

            //必須是image的驗證
            $input = array('image' => $file);
            $rules = array(
                'image' => 'image'
            );
            
            $validator = \Validator::make($input, $rules);
            if ( $validator->fails() ) {
                \debug('1');
                return collect(['ServerNo'=>'404','Result' =>$validator->getMessageBag()->toArray()]);

            }else{
                /*
                $destinationPath = public_path().env('PHOTO_PATH').$catalog;

                if (!is_dir($destinationPath))
                {
                    mkdir($destinationPath);
                }*/

                //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
                $filename = $id.'.jpg';//$file->getClientOriginalName();

                $FilePath=config('app.fellowship_photo_path').'/'.$filename;
                $data = fellowship_d::find($id);
                \debug($filename);
                $data->image_path = env('APP_URL').Storage::url($FilePath);
                $data->save();


                /*
                 * 2017/12/22   使用Laravel內建儲存檔案的方法
                 *              此處會將檔案存到指定路徑下(storage下)，
                 *              第一個參數是完整資料夾
                 *              第二個參數是圖片檔案
                 * */
                Storage::put(
                    $FilePath,
                    file_get_contents($request->file('image')->getPathname()
                    //file_get_contents($request->file('image')->getLinkTarget()
                    )
                );

                /*//  移動檔案
                if(!$file->move($destinationPath,$filename)){
                    // return response()->json(['ServerNo' => '404','Result' => '圖片儲存失敗！']);
                    return collect(['ServerNo'=>'404','Result' => '圖片儲存失敗！']);
                }*/

                 return collect(['ServerNo'=>'200','Result'=>'照片上傳成功！']);
            }
            
        }

        public function getOrderByPageing($num)
        {
             return $this->dtFellowship->orderBy('cod_id','desc')->paginate($num);
        }

        /*
         *  取出使用者點選團契明細資訊
         * */
        public function getFellowshipD($fellowship_id)
        {
            return $this->dtFellowship_d->where('fellowship_id','=',$fellowship_id)->first();
        }

        public function getSunday()
        {
            return $this->dtFellowship->where('NAME','LIKE','%' . '成人主日學' . '%')->select('id')->get();
        }

        public function find($id)
        {
            return $this->dtFellowship_d->where('fellowship_id','=',$id)->get();
        }

    }