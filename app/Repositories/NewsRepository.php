<?php 
    namespace App\Repositories;
// model/Repositories/Pokemon/PokemonRepository.php
    use Illuminate\Http\Request;
    use Models\news;
    use Validator;
    use DB;
    use Response;
    use Storage;

/**
* Our pokemon repository, containing commonly used queries
* 我們的 pokemon 資源庫，包含一些常用的查詢
*/
    class NewsRepository implements ISearch
    {
        private $dtNews;

        public function __construct(news $dtNews)
        {
            $this->dtNews=$dtNews;
        }

        // 撈出資料表全部資料
        public function getAll()
        {
            return $this->dtNews->all();

        }

        public function Search($Value)
        {

            $SearchKey= "%".$Value."%";
           return $this->dtNews
                ->where('title', 'like',  $SearchKey)
                ->orwhere('content','like', $SearchKey)
                ->get();

        }

        public function find($id)
        {
            return $this->dtNews::find($id);
        }

        /*
        分頁功能
        */
        public function Page($value)
        {
            // $dtmore_youtube = more_youtube::paginate(1);
            return $this->dtNews::paginate($value);
        }

        public function getResult()
        {}
        public function setTable()
        {}

        public function save(Request $request)
        {
            $rules = array (
            'news_title'=> 'required',
            'action_date'=> 'required'
            );
            $messages = ['news_title.required' => '請輸入消息標題'
                        ];

            $validator = Validator::make ( $request->all(), $rules , $messages );
            if ($validator->fails ()){
//                \Debugbar::info($validator->messages()->all());
                return  collect(['ServerNo'=>'404','Message' =>  $validator->messages()->all()
                ,               'Key'=>$validator->messages()->keys(),'Message'=>'儲存失敗']);

            }
            else {
//                    DB::connection()->getPdo()->beginTransaction();
                // \Debugbar::info($request);
                if($request->get('id')=="")
                {

                    $data = new news();

                }else{
                    $data = $this->dtNews->find($request->id);
                }

                $data->title = $request->news_title;
                $data->action_date = $request->action_date;
                $data->action_time = $request->action_time;
                $data->action_position=$request->action_position;
                $data->content = $request->news_content;
                $data->save ();

//              DB::connection()->getPdo()->commit();
                return  collect(['ServerNo'=>'200','data'=>$data,'content'=>str_replace('&nbsp;','',mb_substr(strip_tags ($data->content),0,25,"utf-8")).'...','Message'=>'儲存成功！','id'=>$data->id]);
            }
//            }catch (\PDOException $e)
//            {
//                DB::connection()->getPdo()->rollBack();
//            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtNews->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }

        //  排序 由大道小
        public function sortByDesc($column_name)
        {   
            // \Debugbar::info($column_name);
            return $this->dtNews->sortByDesc($column_name);
        }

        //  排序 由小到大
        public function sortBy($column_name)
        {
            return $this->dtNews->sortBy($column_name);
        }

        public function orderBy($column_name)
        {
            return $this->dtNews::orderBy($column_name,'desc');
        }

         public function show_news($column,$operator,$number)
        {   
            // \Debugbar::info( $this->dtNews->where($column,$operator,$number));
            return  $this->dtNews->where($column,$operator,$number)->orderBy('action_date','desc')->paginate(5);
            // $this->dtNews->where($column,$operator,$number)->orderBy('action_date','desc')->paginate(10);
        }

        public function getWidgetNews()
        {
            return DB::select('SELECT id,title,content
                            ,year(action_date) as year
                            ,month(action_date) as month
                            ,day(action_date) as day
                            ,"月" as tag 
                            FROM news 
                            order by action_date desc
                            limit 3' );
        }

        /*
              上傳圖片的function
              2017/05/13
              2017/12/22 修改儲存照片的方法，原來方法是使用move方式，
                         但後來發現，在windows環境，移動過去後會沒有權限，
                         導致相片無法顯示，改成使用Storage這Class
          */
        public function CreatePhotoUpload(Request $request,$id)
        {
            $file = $request->file('image');
            //\Debugbar::info($request->file('image'));


            //必須是image的驗證
            $input = array('image' => $file);
            $rules = array(
                'image' => 'image'
            );

            $validator = \Validator::make($input, $rules);
            if ( $validator->fails() ) {
                return collect(['ServerNo'=>'404','Result' =>$validator->getMessageBag()->toArray()]);
            }else{

                /*$destinationPath = public_path().config('app.news_photo_path');


                if (!is_dir($destinationPath))
                {
                    mkdir($destinationPath);
                }*/

                //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
                $filename = $id.'.jpg';//$file->getClientOriginalName();

//                $FilePath=Storage::putFileAs(config('app.test_news_photo_path'),$file,$filename);
//                \Debugbar::info(Storage::url($FilePath));

                $FilePath=config('app.news_photo_path').'/'.$filename;
                $data = news::find($id);

                $data->image = env('APP_URL').Storage::url($FilePath);
                $data->save();
                //\Debugbar::info($FilePath);
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

                //  移動檔案
                /*if(!$file->move($destinationPath,$filename)){
                    // return response()->json(['ServerNo' => '404','Result' => '圖片儲存失敗！']);
                    return collect(['ServerNo'=>'404','Result' => '圖片儲存失敗！']);
                }*/

                return collect(['ServerNo'=>'200','Result'=>'照片上傳成功！']);
                // return response()->json(['ServerNo' => '200','Result' => '照片上傳成功！']);
            }

        }
    } 