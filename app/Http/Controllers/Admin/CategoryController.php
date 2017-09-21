<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    private $categories;
    private $dtCategory;

    public function __construct(CategoryRepository $CategoryRepository)
    {
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

        return view('DataMaintain.MA_Category',compact('categories','ItemAll'));
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {

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