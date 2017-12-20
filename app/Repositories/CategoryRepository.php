<?php 
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use Models\Category;
    use Validator;
    use Response;
    use DB;

    class CategoryRepository 
    {
	  	private $dtCategory;

        public function __construct(Category $data)
        {
            $this->dtCategory=$data;
        }

        public function getAll()
        {
        	return $this->dtCategory->all();
        }

        public function save(Request $request)
        {

            $rules = array (
                'title' => 'required'
            );

            $input=$request->all();
            $Result=collect();
            $validator = Validator::make ( $request->all(), $rules );
            if ($validator->fails ()){       
                 // return Response::json ( 
                 //    array ('errors' => $validator->messages()->all() ));
                 // return response()->json(['ServerNo' => '404','errors' =>  $validator->messages()->all()]);
                return collect(['0'=>false,'1'=>'Title為必輸欄為']);
            }
            else {
                // \Debugbar::info($input['parent_id']);
                // \Debugbar::info($input['parent_id']);
                if ($request->parent_id==='0' )
                {
                    $request->parent_id=0;
                }
                else {
                    $RowCategory=$this->dtCategory->where('title','=',$input['parent_id'])->pluck('id');
                    \Debugbar::info($RowCategory);
                    $request->parent_id=$RowCategory[0];
                }

                if(!$this->CheckSameData($request->parent_id,$request->title))
                    return collect(['0'=>false,1=>'資料分類節點有重複']);
                
                $data = new Category();
               
                $data->title = $request->title;
                $data->value = NULL;
                $data->parent_id = $request->parent_id;

                $data->save ();

                return collect(['0'=>true,1=>'新增成功']);
            }
        }

        public function delete($id)
        {
            // \Debugbar::info($id);
            $data = $this->dtActionPhoto->find($id)->delete();
            //MeetingInfo::find ( $request->id )->delete ();
            return response ()->json ();
        }


         /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function addCategory(Request $request)
        {
            $this->validate($request, [
                'title' => 'required',
            ]);
            $input = $request->all();

            // \Debugbar::info($input['parent_id']);
            if ($input['parent_id']==='Add Years' )
            {
                 $input['parent_id']=0;
            }
            else {
                $input['parent_id']=Category::where('title','=',$request->parent_id)->pluck('id');
            }

            Category::create($input);

            return back()->with('success', 'New Category added successfully.');
        }

        public function CheckSameData($parent_id,$title)
        {
            if ($this->dtCategory->where('parent_id','=',$parent_id)->where('title','=',$title)->count()>0)
                return false;
            else
                return true;
        }

        public function getParentNode()
        {

            return $this->dtCategory->where('parent_id', '=', 0)->get();
        }

        public function AutoCreateCategory()
        {
            $strThisMonth=(int)date("m");//date('m',strtotime("+1 month"));
            $strThisYear=date("Y");

            $strParentNode = $this->dtCategory->where('title','=',$strThisYear)
                                              ->where('parent_id','=',0)
                                              ->first();
            $strChildNode = $this->dtCategory->where('title','=',$strThisMonth)->get();

            //\Debugbar::info($strParentNode->id);

            /*
             * 如果發現當年度還未新增至Category分類時
             * 就將該年度存入資料庫
             * 年度都是會分類的根節點
             * 接著才是該年度月份資料
             * */
            if(count($strParentNode)==0)
            {
                $dataParentNode = new Category();

                $dataParentNode->title = $strThisYear;
                $dataParentNode->value = 0;
                $dataParentNode->parent_id = 0;
                $dataParentNode->save ();

                //\Debugbar::info($dataParentNode->id);
                $dataChildNode = new Category();

                $dataChildNode->title = $strThisMonth;
                $dataChildNode->value = $strThisMonth;
                $dataChildNode->parent_id = $dataParentNode->id;
                $dataChildNode->save ();

            }else if(count($strChildNode)==0){

                $dataChildNode = new Category();

                $dataChildNode->title = $strThisMonth;
                $dataChildNode->value = $strThisMonth;
                $dataChildNode->parent_id = $strParentNode->id;
                $dataChildNode->save ();
                \Debugbar::info($dataChildNode);
            }
        }

    }