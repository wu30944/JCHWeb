<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\codtbld;
    use Validator;
    use Response;

    class codtbldRepository 
    {
        private $dtCodtbld;

        public function __construct(codtbld $data)
        {
            $this->dtCodtbld=$data;
        }

        public function getAll()
        {
        	return $this->dtCodtbld->all();
        }

        public function getWhere($cod_type)
        {
            return $this->dtCodtbld::where('cod_type','=',$cod_type)->get();
        }

        public function save(Request $request)
        {
            $rules = array (
            'name'=> 'required',
            'cod_id'=>'required'
            );


            $validator = Validator::make ( $request->all(), $rules );
            if ($validator->fails ()){       
                 // return Response::json ( 
                 //    array ('errors' => $validator->messages()->all() ));
                  return response()->json(['ServerNo' => '404','errors' =>  $validator->messages()->all()]);
            }
            else {
                 
                 
                if($request->id==NULL)
                {

                    $data = new action_photo();
                }else{
                    $data = $this->dtCodtbld->find($request->id);
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
                return response ()->json ( ['ServerNo'=>'200','data'=>$data ]);
            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtCodtbld->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }



    }