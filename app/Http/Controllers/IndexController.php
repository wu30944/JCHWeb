<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\MeetingInfo;
use Models\fellowship;
use Models\verse;
use Models\more_youtube;
use Models\news;
use DB;

//2017/06/26 新增action_photo資料表，將活動照片連結存放近來
use App\Repositories\ActionPhotosRepository;
use App\Repositories\MoreYoutubeRepository;
use App\Repositories\NewsRepository;
use App\Repositories\FellowshipRepository;
use App\Repositories\MeetingRepository;

class IndexController extends Controller
{
    public $dtFellowship ;
    public $dtPhoto_action;
    public $dtMoreYoutube;
    public $dtNews;
    public $dtMeetingInfo;

    public function __construct(ActionPhotosRepository $ActionPhotosRepository,MoreYoutubeRepository $MoreYoutubeRepository,NewsRepository $NewsRepository,
        FellowshipRepository $FellowshipRepository,
        MeetingRepository $MeetingRepository)
    {   
        $this->dtPhoto_action=$ActionPhotosRepository;
        $this->dtMoreYoutube=$MoreYoutubeRepository;
        $this->dtNews=$NewsRepository; 
        $this->dtFellowship=$FellowshipRepository;
        $this->dtMeetingInfo=$MeetingRepository;
    }

    //
    public function index()
    {
       $dtfellowship =fellowship::all();
       $dtVerse=verse::all()->where('is_show','1');
          // \Debugbar::info($dtVerse);
       $photo_link = $this->dtPhoto_action->getAll();

       $NewVideo=$this->dtMoreYoutube->getNewVideo();

       $WidgetNews=$this->dtNews->getWidgetNews();
       
       $dtSundayID=$this->dtFellowship->getSunday();

        $item=collect([]);
        $count=0;
        // $item->push('新增年份');
        foreach ($dtSundayID as $key) {
            # code...
            // $item->push($key->title);
            $item[$count++]=$key->id;
        }

        $ItemAll=$item->all();

        $WidgetMeetingInfo=$this->dtMeetingInfo->getWidgetMeetingInfo($ItemAll);

        return view('home.index')->with('dtfellowship',$dtfellowship)->with('dtVerse',$dtVerse)->with('photo_link',$photo_link)->with('NewVideo',$NewVideo)->with('WidgetNews',$WidgetNews)->with('WidgetMeetingInfo',$WidgetMeetingInfo);
    }

    public function more_youtube()
    {
        $dtfellowship =fellowship::all();

        $dtmore_youtube = more_youtube::orderBy('video_date','desc')->paginate(9);

        $count = 0;

        foreach ($dtmore_youtube as $key) {
            # code...
        $Html_youtube[$count]= '<iframe class="embed-responsive-item" src="'.$key->link.'" frameborder="0" allowfullscreen></iframe>';
        $count++;
        }
        return view('more.more_youtube',compact('dtfellowship'),compact('dtmore_youtube'));        // return view('more.more_youtube')->with('dtmore_youtube',$dtmore_youtube);

    }

    /*
    點選導覽列的團契生活，到資料庫抓取Blade檔案名稱
    與存放在哪個目錄下，再把它給串接起來
    */
    public function fellowship($id)
    {
        //取得View的名稱
        $dtfellowship =fellowship::all();
        $BladeName=$dtfellowship->where('id',$id);
        foreach($BladeName as $value)
        {
            $Name=$value->PARA_1;
            $Catalog = $value->PARA_2;
        }

        $fellowship_info=DB::select('SELECT * FROM fellowships a 
                            INNER join fellowship_d b
                            on a.PARA_1=b.id
                            where a.id=?', [$id]);

        foreach($fellowship_info as $value)
        {
            $page_title=$value->name;
        }

        \Debugbar::info($fellowship_info);

        $View=$Catalog.'.'.$Name;
        return view('fellowship.fellowship_info')->with('dtfellowship',$dtfellowship)->with('fellowship_info',$fellowship_info)->with('page_title',$page_title);
    }

    public function news()
    {
        $query=news::all();
        $dtfellowship =fellowship::all();
        return view('news.news',compact('query'),compact('dtfellowship'));
    }

    public function news_d()
    {
        $dtfellowship =fellowship::all();
        return view('news.news_d',compact('dtfellowship'));
    }

    public function addtest()
    {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $active = $_POST['active'];
     
        $sql = "INSERT INTO members (name, contact, address, active) VALUES ('$name', '$contact', '$address', '$active')";
        $query = $connect->query($sql);
     
        if($query === TRUE) {           
            $validator['success'] = true;
            $validator['messages'] = "Successfully Added";      
        } else {        
            $validator['success'] = false;
            $validator['messages'] = "Error while adding the member information";
        }
     
        // close the database connection
        $connect->close();
     
        echo json_encode($validator);

    }
    public function GetNavigation()
    {
         $dtfellowship =fellowship::all();
                 \Debugbar::info($dtfellowship);
        return view('inc.navigation')->with('dtfellowship',$dtfellowship);
    }
}


