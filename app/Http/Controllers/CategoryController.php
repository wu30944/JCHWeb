<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Models\Category;
use App\Repositories\FellowshipRepository;

use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    private $fellowshipRepository;
    private $categories;
    private $dtCategory;

    public function __construct(FellowshipRepository $fellowshipRepository,CategoryRepository $CategoryRepository)
    {
        $this->fellowshipRepository=$fellowshipRepository;
        $this->dtCategory=$CategoryRepository;
        $this->categories = Category::where('parent_id', '=', 0)->get();
    }

    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        return view('category.categoryTreeview',compact('categories','allCategories'));
    }


    public function MA_Category()
    {

        $categories = $this->categories;
        $allCategories = Category::where('parent_id','=',0)->get();
        $item=collect(['0'=>'新增分類']);
        // $item->push('新增年份');
        foreach ($allCategories as $key) {
            # code...
            // $item->push($key->title);
            $item[$key->title]=$key->title;
        }

        $ItemAll=$item->all();

        $dtfellowship = $this->fellowshipRepository;
          //Debug專用
         \Debugbar::info( $dtfellowship );

        return view('DataMaintain.MA_Category',compact('dtfellowship','categories','ItemAll'));
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        // ]);
        // $input = $request->all();

        // // \Debugbar::info($input['parent_id']);
        // if ($input['parent_id']==='Add Years' )
        // {
        //      $input['parent_id']=0;
        // }
        // else {
        //     $input['parent_id']=Category::where('title','=',$request->parent_id)->pluck('id');
        // }

        // Category::create($input);
        $Result=$this->dtCategory->save($request);
        if($Result[0])
        {
            return back()->with('success', $Result[1]);
        }else
        {
            return back()->with('fails', $Result[1]);
        }


    }

    //     /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addCategory(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //     ]);
    //     $input = $request->all();

    //     $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

    //     Category::create($input);

    //     return back()->with('success', 'New Category added successfully.');
    // }

}