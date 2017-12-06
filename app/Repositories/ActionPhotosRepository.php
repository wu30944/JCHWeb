<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\action_photo;
    use Validator;
    use Response;

    class ActionPhotosRepository 
    {
	  	private $dtActionPhoto;

        public function __construct(action_photo $data)
        {
            $this->dtActionPhoto=$data;
        }

        public function getAll()
        {
        	return $this->dtActionPhoto->all();
        }

        public function save(Request $request)
        {
            $rules = array (
            'photo_link'=> 'required',
            'photo_date'=>'required'
            );

            $messages = ['photo_link.required' => trans('message.photo_link')
                ,'photo_date.required'=>trans('message.photo_date')];
            $validator = Validator::make ( $request->all(), $rules,$messages );

            if ($validator->fails ()){       
                 // return Response::json ( 
                 //    array ('errors' => $validator->messages()->all() ));
                  return response()->json(['ServerNo' => '404','errors' =>  $validator->messages()->all(),'Message'=>'儲存失敗'],403);
            }
            else {
                 
                 
                if($request->id==NULL)
                {

                    $data = new action_photo();
                }else{
                    $data = $this->dtActionPhoto->find($request->id);
                }

               
                $data->title = $request->theme;
                $data->photo_link = $request->photo_link;
                $data->content = $request->content;
                $data->para_1=$request->para_1;
                $data->para_2=$request->para_2;
                $data->para_3=$request->para_3;
                $data->photo_date=$request->photo_date;
                $data->save ();

                // Session::flash('message', 'Successfully updated nerd!');
                // return response ()->json ( $data );
                return response ()->json ( ['ServerNo'=>'200','data'=>$data,'Message'=>'儲存成功' ],200);
            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtActionPhoto->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }

    }