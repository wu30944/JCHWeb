<?php 
    namespace App\Repositories;
// model/Repositories/Pokemon/PokemonRepository.php
    use Illuminate\Http\Request;
    use Models\more_youtube;
    use Validator;
    use Response;

    class MoreYoutubeRepository 
    {
    	private $dtVideos;

        public function __construct(more_youtube $data)
        {
            $this->dtVideos=$data;
        }

        /*
            為了取得最新的影片資訊
        */
        public function getNewVideo()
        {
             return $this->dtVideos->orderBy('video_date','desc')->first();
        }

        public function getAll()
        {
        	return $this->dtVideos->all();
        }

        public function getOrderByPageing($num)
        {
        	 return $this->dtVideos->orderBy('video_date','desc')->paginate($num);
        }

       public function getVideoOrderByPageing($num,$video_type)
        {
             return $this->dtVideos->where('type','=',$video_type)->orderBy('video_date','desc')->paginate($num);
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtVideos->find($id)->delete();
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

                 return  collect(['ServerNo'=>'404','message' =>  $validator->messages()->all()]);
            }
            else {
                            
                if($request->id=="" || $request->id==NULL)
                {

                    $data = new more_youtube();
                }else{
                    $data = $this->dtVideos->find($request->id);
                }
               
                $data->link = $request->video_link;
                $data->theme = $request->theme;
                $data->name = $request->speaker;
                $data->video_date=$request->video_date;
                $data->type = $request->video_type;
                $data->save ();  

                // Session::flash('message', 'Successfully updated nerd!');
                // return response ()->json ( ['ServerNo'=>'200','data'=>$data ]);
                return  collect(['ServerNo'=>'200','message' =>'儲存成功！','data'=>$data]);
            }
        }

    }