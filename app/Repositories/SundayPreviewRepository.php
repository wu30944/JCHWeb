<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\sunday_preview;
    use Validator;
    use Response;
    use DB;


    class SundayPreviewRepository
    {
	  	private $dtSundayPreview;

        public function __construct(sunday_preview $data)
        {
            $this->dtSundayPreview=$data;
        }

        public function getAll()
        {
        	return $this->dtSundayPreview->all();
        }

        /*
            20170919.  用來取得主日預告的相關資訊，只要是預告日期大於等於今天日期都要顯示出來
        */
        public function getSundayPreviewInfo()
        {   
            \Debugbar::info(date("Y-m-d" , mktime(0,0,0,date("m"),date("d")-7,date("Y"))));
            return $this->dtSundayPreview->where('date','>=',date("Y-m-d" , mktime(0,0,0,date("m"),date("d")-7,date("Y"))))->orderBy('date','asc')->get();
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
                    $staffd_id = $this->dtStaff_D->where('staff_id','=',$request->id)->pluck('id');
                    // \Debugbar::info(count($staffd_id));
                    if(count($staffd_id)>0)
                    {   
                        $data_d=$this->dtStaff_D->find($staffd_id);
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
                && $this->dtStaff_D->where('staff_id','=',$id)->delete())
            {
                 return  collect(['ServerNo'=>'success','Result' =>'刪除成功！']);
            }else{
                 return  collect(['ServerNo'=>'fails','Result' =>'刪除失敗！']);
            }

        }

        public function getWidgetMeetingInfo($MeetingID)
        {

            return $this->dtSundayPreview->whereIn('fellowship_id',$MeetingID)->get();
        }

        public function getOrderByPageing($num)
        {
             return $this->dtStaff->orderBy('cod_id','desc')->paginate($num);
        }
    }