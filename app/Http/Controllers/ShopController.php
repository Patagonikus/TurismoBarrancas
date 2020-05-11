<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\PriceTag;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::where('active','!=','0')->inRandomOrder()->paginate(9);

        $products = Product::where('active','!=','0')->paginate(9);
       
        $categories = Category::where('active','!=','0')->get();
        $selectedCategory=null;
        
        $priceTags=PriceTag::all();
        $selectedPriceTag=null;
        

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'priceTags'=>$priceTags,
                'selectedCategory'=>$selectedCategory,
                'selectedPriceTag'=>$selectedPriceTag,
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::where('id',$id)->firstOrFail();
        $product = Product::where('id',$id)->firstOrFail();
        $mightAlsoLike = Product::where('id','!=',$id)->where('active','!=','0')->mightAlsoLike()->get();

        return view('product')->with([
                'product'=> $product,
                'mightAlsoLike'=> $mightAlsoLike,
            ]);
    }


        /**
     * Display the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function filterByCategory($categoryId)
    {

        $selectedCategory=Category::where('id',$categoryId)->firstOrFail();
        $categories = Category::where('active','!=','0')->get();

        $products=$selectedCategory->getProducts();

        $priceTags=PriceTag::all();
        $selectedPriceTag=null;

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'priceTags'=>$priceTags,
                'selectedCategory'=>$selectedCategory,
                'selectedPriceTags'=>$selectedPriceTag,
            ]);

    }

        /**
     * Display the specified resource.
     *
     * @param  int  $priceTagId
     * @return \Illuminate\Http\Response
     */
    public function filterByPrice($priceTagId)
    {
        $selectedPriceTag=PriceTag::find($priceTagId);
        $priceTags=PriceTag::all();

        $products=Product::where('active','!=','0')->where('price','>=',$selectedPriceTag->min)->where('price','<=',$selectedPriceTag->max)->paginate(9);
        
        $categories = Category::where('active','!=','0')->get();
        $selectedCategory=null;

        return view('shop')
            ->with([
                'products'=>$products,
                'categories'=>$categories,
                'priceTags'=>$priceTags,
                'selectedCategory'=>$selectedCategory,
                'selectedPriceTag'=>$selectedPriceTag,
            ]);

    }
    

}
