<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories =Category::all();
        $products=Product::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->when($request->category_id , function ($query) use ($request){
            return $query->where('category_id',$request->category_id);
        })->latest()->paginate(5);
//        $products=Product::paginate(5);
        return view('dashboard.product.index' ,compact('products' , 'categories'));
    }
//products
    public function create()
    {
        $categories=Category::all();
        return view('dashboard.product.create'  ,compact('categories'));
    }

    public function store(Request $request)
    {

        $rules=[
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',

        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];

        }
        $request->validate($rules);

        $request_data=$request->except(['image']);
        $image=$request->image;
        $image_new=time().$image->getClientOriginalName();
        $image->move('uploads/products/' ,$image_new );
        $request_data['image']='uploads/products/'.$image_new;
        Product::create($request_data);

        session()->flash('AddTrue' , 'THE PRODUCT ADDED SUCESSFULLY');
        return redirect()->back();

    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories=Category::all();
        return view('dashboard.product.edit' , compact('product' , 'categories'));
    }


    public function update(Request $request, Product $product)
    {

        $rules=[
            'category_id'=>'required',
            'purchase_price'=>'required',
            'sale_price'=>'required',
            'stock'=>'required',

        ];
        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required' , Rule::unique('product_translations')->ignore($product->id)];
            $rules += [$locale . '.description' => 'required' , Rule::unique('product_translations')->ignore($product->id)];

        }
        $request->validate($rules);

        $request_data=$request->except(['image']);
        $image=$request->image;
        $image_new=time().$image->getClientOriginalName();
        $image->move('uploads/products/' ,$image_new );
        $request_data['image']='uploads/products/'.$image_new;
        $product->update($request_data);

        session()->flash('AddTrue' , 'THE PRODUCT UPDATED SUCESSFULLY');
        return redirect()->route('dashboard.product.index');

    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
