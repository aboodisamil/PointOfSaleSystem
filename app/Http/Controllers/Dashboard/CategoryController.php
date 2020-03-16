<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');

    }

    public function index(Request $request)
    {
        $categories=Category::when($request->search, function ($q) use ($request) {

        return $q->whereTranslationLike('name', '%' . $request->search . '%');

    })->latest()->paginate(5);

//        $categories=DB::table('categories')->latest()->paginate();
        return view('dashboard.category.index' , compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');

    }

    public function store(Request $request)
    {

        $request_data=$request->all();
        Category::create($request_data);
        session()->flash('AddTrue' ,'THE CATEGORY ADDED SUCCESSFULLY');
        return redirect()->back();
    }

    public function show($id)
    {
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit' ,compact('category'));
    }

    public function update(Request $request, Category $category)
    {
//        $request->validate([
//            'name'=>['required' , Rule::unique('category_translations')->ignore($category->id)]
//        ]);


        $request_data=$request->all();
        $category->update($request_data);
        session()->flash('AddTrue' , 'THE CATEGORY UPDATED SUCESSFULLY');
        return redirect()->route('dashboard.category.index');

    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('AddTrue' , 'THE CATEGORY DELETED SUCESSFULLY');
        return redirect()->back();
    }
}
