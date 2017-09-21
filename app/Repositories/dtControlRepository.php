<?php 
    namespace App\Repositories;
// model/Repositories/Pokemon/PokemonRepository.php
    use Illuminate\Http\Request;
    use Models\dtControl;
    use Validator;
    use Response;
    use DB;

    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;

    class dtControlRepository 
    {
        private $dtControl;

        public function __construct(dtControl $data)
        {
            $this->dtControl=$data;
        }

        public function getAll()
        {
            return $this->dtControl->all();
        }

        public function getTableSetting($blade)
        {   
            return $this->dtControl->where('BLADE_NAME','=',$blade)->get();
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtControl->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }

         public function save(Request $request)
        {

            $rules = array (
            'video_link'=> 'required',
            'speaker'=> 'required',
            'theme'=>'required',
            'video_date'=>'required',
            'video_type'=>'not_in:choice'
            );

            $messages = ['video_link.required' => '影片連結不能空白'
                         ,'speaker.required' => '演說者不能空白'
                         ,'theme.required' => '影片主題不能空白'
                         ,'video_date.required' => '影片日期不能空白'
                         ,'video_type.not_in'=>'請選擇影音類型'];

            $validator = Validator::make ( $request->all(), $rules,$messages );             
            \Debugbar::info($request->video_link);

            // $validator = Validator::make ( $request->all(), $rules );
            if ($validator->fails ()){      
                \Debugbar::info($validator->messages());
                 return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
            }
            else {
                            
                if($request->id=="" || $request->id==NULL)
                {

                    $data = new more_youtube();
                }else{
                    $data = $this->dtControl->find($request->id);
                }
               
                $data->link = $request->video_link;
                $data->theme = $request->theme;
                $data->name = $request->speaker;
                $data->video_date=$request->video_date;
                $data->type = $request->video_type;
                $data->save ();  

                // Session::flash('message', 'Successfully updated nerd!');
                // return response ()->json ( ['ServerNo'=>'200','data'=>$data ]);
                return  collect(['ServerNo'=>'200','Result' =>'儲存成功！','data'=>$data]);
            }
        }

        public function query(Request $request)
        {
            // \Debugbar::info($request->SearchSpeaker);
            $empty='';
            $query = DB::select( DB::raw('select *
                                     from youtube_link a
                                     where (type=? or ?= ?)
                                     and (name = ? or ?=?)
                                     and (theme = ? or ?=?)
                                     and (video_date between ?  and ? )' )
                                    ,[$request->SearchVideoType,
                                        $request->SearchVideoType,
                                        $empty,
                                        $request->SearchSpeaker,
                                        $request->SearchSpeaker,
                                        $empty,
                                        $request->SearchTheme,
                                        $request->SearchTheme,
                                        $empty,
                                        $request->SearchSDate,
                                        $request->SearchEDate]);   

            $page = Paginator::resolveCurrentPage("page");
            $perPage = 9; //實際每頁筆數
            $offset = ($page * $perPage) - $perPage;

            $data = new LengthAwarePaginator(array_slice($query, $offset, $perPage, true), count($query), $perPage, $page, ['path' =>  Paginator::resolveCurrentPath()]);

            return $data;
        }

    }