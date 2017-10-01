<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\verse;
    use Validator;
    use Response;
    use DB;


    class VersesRepository
    {
	  	private $dtVerses;

        public function __construct(verse $data)
        {
            $this->dtVerses=$data;
        }

        public function getAll()
        {
        	return $this->dtVerses->all();
        }


        public function save(Request $request)
        {
            try{

                $rules = array (
                    'content'=> 'required',
                    'chapter'=>'required'
                );
                $messages = ['content.required' => '請輸入聖經內容'
                             ,'chapter.required'=>'請選輸入聖經章節'];

                $validator = Validator::make ( $request->all(), $rules,$messages );
    //            \Debugbar::info($request->duty);
                if ($validator->fails ()){
                     // return Response::json (
                      \Debugbar::info($validator->messages()->all());
                      return  collect(['ServerNo'=>'404','Result' =>  $validator->messages()->all()]);
                }
                else {

                    DB::connection()->getPdo()->beginTransaction();
                          // \Debugbar::info('2');
                    if($request->id=="" || $request->id==NULL)
                    {
                        $data = new verse();
                        $data->is_show = 0;
                        $data->content = $request->content;
                        $data->chapter = $request->chapter;
                        $data->save ();

                    }else{
                        $data = $this->dtVerses->find($request->id);
                        $data->is_show = $request->is_show;
                        $data->content = $request->content;
                        $data->chapter = $request->chapter;
                        $data->save ();

                    }
                    DB::connection()->getPdo()->commit();
                    return  collect(['ServerNo'=>'200','Result' =>'儲存成功！','data'=>$data]);

                }
            }catch (\PDOException $e)
            {
                DB::connection()->getPdo()->rollBack();
            }
        }

        /*
         * 201701001   金句刪除
         * */
        public function delete($id)
        {
            try{
                DB::connection()->getPdo()->beginTransaction();

                    // \Debugbar::info($id);
                $this->dtVerses->find($id)->delete();
                DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'success','Result' =>'刪除成功！']);

            }catch (\PDOException $e)
            {
                DB::connection()->getPdo()->rollBack();
            }

        }

        public function UpdateIsShow(Request $request)
        {
//            \Debugbar::info($request->is_show);
//            \Debugbar::info($request->no_show);
            try{
                DB::connection()->getPdo()->beginTransaction();

                $is_data = $this->dtVerses->find($request->is_show);
                $is_data->is_show = 1;
                $is_data->save ();

                $no_data = $this->dtVerses->find($request->no_show);
                $no_data->is_show = 0;
                $no_data->save ();

                DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'200','Result' =>'更改成功！']);
            }catch (\PDOException $e)
            {
                DB::connection()->getPdo()->rollBack();
            }
        }

    }