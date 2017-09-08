<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\jch_info;
    use Validator;
    use Response;

    class JchInfoRepository 
    {
	  	private $dtJchInfo;

        public function __construct(jch_info $data)
        {
            $this->dtJchInfo=$data;
        }

        public function getAll()
        {
        	return $this->dtJchInfo->all();
        }

        public function save(Request $request)
        {

            $rules = array (
                'cname'=> 'required',
                'ename'=>'required',
                'email'=>'required',
                'address'=>'required',
                'fex'=>'required',
                'uniform_number'=>'required',
                'phone'=>'required'
            );
            $messages = ['cname.required' => '教會中文欄位不能空白'
                         ,'ename.required'=>'教會英文名稱欄位不能空白'
                         ,'email.required'=>'E-mail欄位不能空白'
                         ,'address.required'=>'教會地址欄位不空白'
                         ,'fex.required'=>'傳真欄位不能空白'
                         ,'uniform_number.required'=>'統一編號不能空白'
                         ,'phone.required'=>'電話欄位不能空白'];
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
                    $data = new jch_info();
                }else{
                    $data = $this->dtJchInfo->find($request->id);
                }
  
                $data->cname = $request->cname;
                $data->ename = $request->ename;
                $data->email = $request->email;
                $data->address = $request->address;
                $data->fex = $request->fex;
                $data->uniform_number = $request->uniform_number;
                $data->phone = $request->phone;
                $data->save ();

                // Session::flash('message', 'Successfully updated nerd!');
                // return response ()->json ( $data );
                return  collect(['ServerNo'=>'200','Result' =>'儲存成功！','id'=>$data->id]);
                // return response ()->json ( ['0'=>'200','Result'=>'儲存成功！' ]);
            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            if( $this->dtJchInfo->find($id)->delete() )
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

                // $dataID=$this->dtJchInfo->where('id','=',$id)->where('cod_id','=',$request->duty)->pluck('id');
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

        public function show()
        {
        //因為教會資訊只會有一筆資料，所以就直接查詢id為1的那筆資料列
             $table=$this->getAll();
             \Debugbar::info($table);
             $dtJch_info =$table->where('id','1');

             //下面將教會資訊從資料庫提取出來，並且放到變數當中，最後再放到陣列中，並且帶到view當中
            foreach($dtJch_info as $jch_info)
            {
              $CNAME=$jch_info->cname;//$test->getTableWhere();
              $ENAME=$jch_info->ename;
              $ADDRESS=$jch_info->address;
              $PHONE=$jch_info->phone;
              $EMAIL=$jch_info->email;
              $UNIFORM=$jch_info->uniform_number;
              $FEX=$jch_info->fex;
              $MAP=$jch_info->map;
              $ID=$jch_info->id;
            }
            //放入陣列當中
            $JCH_INFO= array('CNAME'=>$CNAME,'ENAME'=>$ENAME,'ADDRESS'=>$ADDRESS,'PHONE'=>$PHONE,'EMAIL'=>$EMAIL,'UNIFORM'=>$UNIFORM,'FEX'=>$FEX,'MAP'=>$MAP,'ID'=>$ID);
            return $JCH_INFO;
        }

    }