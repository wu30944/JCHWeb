<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\MeetingInfo;
use Models\Category;
use Models\dtControl;
use Input;
use DB;


use App\Repositories\fellowshipRepository;
use App\Repositories\NewsRepository;
use App\Repositories\CategoryRepository;

class NewsController extends Controller
{

    private $fellowshipRepository;
    private $dtNews;
    private $categories;

    public function __construct(fellowshipRepository $fellowshipRepository
                                ,NewsRepository $NewsRepository
                                ,CategoryRepository $CategoryRepository)
    {
        $this->fellowshipRepository=$fellowshipRepository;
        $this->dtNews=$NewsRepository;
        $this->categories = $CategoryRepository;//Category::where('parent_id', '=', 0)->get();
    }

    /*
     * 顯示消息詳細資訊
     * 2017/09/29  修正點選消息明細如果標題名稱相同，會帶出兩筆資料，因為之前是綁標題去帶資料，應該要改為消息ID去帶資料
     * */
    public function show_news_d($NewsID)
    {

        $dtNews=$this->dtNews->getAll()->where('id',$NewsID);
        $dtfellowship = $this->fellowshipRepository->getAll();//$dtfellowship =fellowship::all();
        return view('news.news_d',compact('dtfellowship'),compact('dtNews'));
    }

    public function show_news()
    {

        $categories = $this->categories->getParentNode();
        //$allCategories = Category::pluck('title','id')->all();

        $dtNews = $this->dtNews->show_news('title','<>',NULL);
        //$test = new NewsRepository();

        $dtfellowship = $this->fellowshipRepository->getAll(); //fellowship::all();
        $isPaging=true;

          //Debug專用
         \Debugbar::info( $categories );

        return view('news.news',compact('dtfellowship'),compact('dtNews','isPaging','categories'));
    }

    public function search()
    {
        $value=Input::get("value");
         //\Debugbar::info( $value );
        # code...
        $dtNews =$this->dtNews->Search($value);
         $dtfellowship = $this->fellowshipRepository->getAll(); //fellowship::all();
        //\Debugbar::info( $dtNews );

        $isPaging=false;

        $categories = $this->categories->getParentNode();
        //return $dtNews;
        return view('news.news',compact('dtfellowship'),compact('dtNews','isPaging','categories'));
    }

    public function search_test(Request $request)
    {
        $News=$this->dtNews->Search($request->key_word);
        
        $total_html="";

//        \Debugbar::info(count($News));
        if(count($News)==0)
        {
            $total_html='查無符合資料';
        }
        else
        {
            foreach($News as $data)
            {   
                $link_html="";
                $link_html='<h2>'.$data->title.'</h2><p><span class="glyphicon glyphicon-time"></i>&nbsp'.$data->action_date.'</p>';
                if($data->image!=="")
                {
                    $link_html=$link_html.'<img class="img-responsive img-hover" src="'.$data->image.'" alt="" style="max-width: 400; max-height: 200px;">';
                }
                /*
                 * 2017/09/29   因為消息當中的搜尋控制項是利用ajax方法所寫，
                 *              所以搜尋出的內容是在php程式中組裝而成，
                 *              原來寫法按下Read more會沒有反應，所以組成html的語法做些小修改
                 *              利用一個參數將route資訊存起來，再把內容給組起來就修正原來
                 *              按下控制項沒有反應的問題
                 * */
                $varRoute = route("news_d",$data->id);
                $link_html=$link_html.'<br><p>'.mb_substr($data->content,0,50,"utf-8").'</p>
                    <a class="btn btn-primary" href="'.$varRoute.'">
                    Read More <i class="fa fa-angle-right"></i></a><hr>';

                $total_html=$total_html.$link_html;
            }
        }
         \Debugbar::info($total_html);
        return response ()->json ( $total_html );
    }


    public function month_search($month)
    {
        $categories  = $this->categories->getParentNode();

        $dtNews=DB::select('select * from news where month(action_date) = ?', [$month]);
        \Debugbar::info( $dtNews );

        $dtfellowship = $this->fellowshipRepository->getAll();//$dtfellowship =fellowship::all();

         $isPaging=false;
        //return $dtNews;
        return view('news.news',compact('dtfellowship'),compact('dtNews','isPaging','categories'));
    }

    public function MA_News()
    {

        // $dtNews = $this->dtNews->getAll();

        $dtNews = $this->dtNews->getAll()->sortByDesc('created_at');


        $dtControl=dtControl::all()->where('BLADE_NAME','MA_News');
        //$test = new NewsRepository();

        $dtfellowship = $this->fellowshipRepository->getAll(); //fellowship::all();
        $isPaging=true;
          
          //Debug專用
         \Debugbar::info( $dtNews );

        return view('DataMaintain.MA_News',compact('dtfellowship','dtControl'),compact('dtNews','isPaging'));
    }

    public function editItem(Request $request)
    {   
         //\Debugbar::info( $request->id );

        $data=$this->dtNews->find($request->id);

         //Debug專用
         //\Debugbar::info( $data );

        return response ()->json ( $data );
    }


    public function saveItem(Request $request)
    {   
        // \Debugbar::info($request);
        return $this->dtNews->save($request);
    }

    public function PhotoUpload(Request $request)
    {
        $file = $request->file('image');
        // \Debugbar::info($file);
        $catalog='/news';

        //必須是image的驗證
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'ServerNo' => '404',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }else{       
            
            $destinationPath = public_path().config('app.news_photo_path');

            // \Debugbar::info($destinationPath);

            if (!is_dir($destinationPath))
            {
                mkdir($destinationPath);
            }
            //都將檔案存成jpg檔案 命名方式依照團契的ＩＤ命名,這樣就不會有重複的問題
            $filename = $request->get('id').'.jpg';//$file->getClientOriginalName();


            $data = $this->dtNews->find($request->get('id'));
            $data->image = config('app.news_photo_path').'/'.$filename;
            $data->save();


            //  移動檔案
            if(!$file->move($destinationPath,$filename)){
                return response()->json(['ServerNo' => '400','ResultData' => '圖片儲存失敗']);
            }

            return response()->json(['ServerNo' => '200','ResultData' => $data->image]);
        }
    }

    public function DeleteItem(Request $request)
    {
        return $this->dtNews->delete($request->get('id'));
    }

    // 2017/06/03  增加最新消息頁面，點選畫面中Read More 進入消息明細
    public function ReadMore(Request $request)
    {

        $dtNews_d=$this->dtNews->find($request->id);

        $total_html="";

        foreach($dtNews_d as $data)
            {   
                $link_html="";
                $link_html='<h2>'.$data->title.'</h2><p><span class="glyphicon glyphicon-time"></i>&nbsp'.$data->action_date.'</p>';
                if($data->image!=="")
                {
                    $link_html=$link_html.'<img class="img-responsive img-hover" src="'.$data->image.'" alt="" style="max-width: 400; max-height: 200px;">';
                }

                $link_html=$link_html.'<br><p>'.$data->content.'</p><hr>';

                $total_html=$total_html.$link_html;
            }

        return response ()->json ( $dtNews_d );
    }

    public function MA_Category()
    {

        $categories = $this->categories->getParentNode();
        //$allCategories = Category::pluck('title','id')->all();
          
          //Debug專用
         //\Debugbar::info( $dtfellowship );

        return view('DataMaintain.MA_Category',compact('categories'));
    }
}
