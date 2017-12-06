<?php
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\sunday_preview;
    use Validator;
    use Response;
    use DB;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;

    use Exception;


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

        /*
            20170919.  用來取得主日預告的相關資訊，只要是預告日期大於等於今天日期都要顯示出來
        */
        public function getWorshipPreviewInfo()
        {
            \Debugbar::info(date("Y-m-d" , mktime(0,0,0,date("m"),date("d")-7,date("Y"))));
            return $this->dtSundayPreview->where('date','>=',date("Y-m-d" , mktime(0,0,0,date("m"),date("d")-7,date("Y"))))
                                         ->orderBy('date','asc')->get();
        }

        public function save(Request $request)
        {

            $rules = array (
                'language_type'=> 'required',
                'subject'=>'required',
                'speaker'=>'required',
                'sunday_date'=>'required'
            );
            $messages = ['language_type.required' => '請至少選擇一種語言'
                         ,'subject.required'=> str_replace('%',trans('default.subject'),trans('message.RequiredField'))
                         ,'speaker.required'=>str_replace('%',trans('default.speaker'),trans('message.RequiredField'))
                         ,'sunday_date.required'=>str_replace('%',trans('default.sunday_date'),trans('message.RequiredField'))
            ];
            // \Debugbar::info($request->name);
            $validator = Validator::make ( $request->all(), $rules, $messages );
            \Debugbar::info($validator->messages()->all());
            if ($validator->fails ()){
                    \Debugbar::info($validator->messages()->all());
                  return  collect(['ServerNo'=>'404','Message' =>  $validator->messages()->all()]);
                  // return response()->json(['0' => '404','Result' =>  $validator->messages()->all()]);
            }
            else {

                /*
                 * 此處是新增資料時
                 * */
                if($request->id==NULL)
                {
                    $LangCount = count($request->language_type);

                    for($i=0;$i<$LangCount;$i++)
                    {
                        $data = new sunday_preview();
                        $data->language_type = $request->language_type[$i];
                        $data->subject = $request->subject;
                        $data->speaker = $request->speaker;
                        $data->date = $request->sunday_date;
                        $data->save ();
                    }
                /*
                 * 此處是修改資料
                 * 可更新其他資訊，但不更新語言
                 * */
                }else{
                    $data = $this->dtSundayPreview->find($request->id);

                    $data->subject = $request->subject;
                    $data->speaker = $request->speaker;
                    $data->date = $request->sunday_date;
//                    $data->language_type = $request->language_type;
                    $data->save ();

                }
                // Session::flash('message', 'Successfully updated nerd!');
                return  collect(['ServerNo'=>'200','Message' =>'儲存成功！','id'=>$data->id,'data'=>$data]);
            }
        }

        public function delete($id)
        {
           $this->dtSundayPreview->find($id)->delete();
           return collect(['ServerNo'=>'200','Message'=> trans('message.DeleteSuccess')]);

        }

        public function getWidgetMeetingInfo($MeetingID)
        {

            return $this->dtSundayPreview->whereIn('fellowship_id',$MeetingID)->get();
        }

        public function getOrderByPageing($num)
        {
             return $this->dtStaff->orderBy('cod_id','desc')->paginate($num);
        }

//        /*
//         * 2017/11/21   新增 信息預告資料查詢
//         * */
//        public function query($subject="",$speaker="",$sdate="",$edate="",$language_type="")
//        {
//            // \Debugbar::info($request->SearchSpeaker);
//            $empty='';
//            $query = DB::select( DB::raw('select * from  sunday_preview a
//                                                where (a.subject = ? or ? = ?)
//                                                and (a.speaker= ? or ?= ?)
//                                                and (a.date between ? and ?)
//                                                and (a.language_type IN (?) or ?=?)' )
//                ,[$subject,
//                    $subject,
//                    $empty,
//                    $speaker,
//                    $speaker,
//                    $empty,
//                    $sdate,
//                    $edate,
//                    $language_type,
//                    $language_type,
//                    $empty]);
//
//            $page = Paginator::resolveCurrentPage("page");
//            $perPage = 9; //實際每頁筆數
//            $offset = ($page * $perPage) - $perPage;
//
//            $data = new LengthAwarePaginator(array_slice($query, $offset, $perPage, true), count($query), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);
//
//            return $data;
//        }

        /*
         * 2017/11/21   新增 信息預告資料查詢
         * */
        public function query($subject="",$speaker="",$sdate="",$edate="",$language_type="")
        {
            // \Debugbar::info($request->SearchSpeaker);
            $test="'";
            $query = DB::select( DB::raw('call spQueryWorshipPreview(?,?,?,?,?)' )
                  ,[$subject,
                    $speaker,
                    $sdate,
                    $edate,
                    $language_type]);

            $page = Paginator::resolveCurrentPage("page");
            $perPage = 9; //實際每頁筆數
            $offset = ($page * $perPage) - $perPage;

            $data = new LengthAwarePaginator(array_slice($query, $offset, $perPage, true), count($query), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);

            \Debugbar::info($data);
            return $data;
        }
    }