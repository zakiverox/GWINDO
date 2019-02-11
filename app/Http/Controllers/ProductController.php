<?php

namespace App\Http\Controllers;

use App\cr;
use App\User;
use App\Image;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Transformers\ProductTransformer;
use App\Fasilitas;

class ProductController extends ApiController 
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'fasilitas' => 'required',
           
        ];

        $this->validate($request, $rules);

        $currentUser = Auth::user()->id;
       

        $product = Product::create([
        'title' =>  $request->title,       
        'description' =>  $request->description,
        'user_id' =>  $currentUser,
        $category =  $request->category,
       ]);  
       $data = array(
        array('fasilitas'=>$request->fasilitas,'product_id' => $product->id),
        array('fasilitas'=>$request->fasilitas1,'product_id' => $product->id),
        array('fasilitas'=>$request->fasilitas2,'product_id' => $product->id),
        array('fasilitas'=>$request->fasilitas3,'product_id' => $product->id),
       );
    
       
       $fasilitas = Fasilitas::insert($data);  
    
    
       
       $ct = Category::where('name', $category)->first();
     
      $product->categorys()->attach($ct);
       return $this->successResponse($product, 201);

        
    }


    public function uploadimages($product,Request $request){


        $rules = [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $this->validate($request, $rules);
        
        
        
       if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
            $size = $image->getClientSize();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $filename);

            $product_img = Image::create([
                'name' =>  $filename,       
                'link' => url("img/{$filename}"),
                'product_id' =>  $product,
                
               ]);      
       
       //$count return only 1(hanya mengupload 1 file)
       return $product_img;
        }
    }
    //aslknsaknsa

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
                   }
                   
             
                   $c = Product::all();
                  

                   return $this->response->collection($c, new ProductTransformer)->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
