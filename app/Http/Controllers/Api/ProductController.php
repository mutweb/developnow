<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
		protected $_uploadFolder = 'uploaded/product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$image = '';
			if( $request->image ) {
				$uploadedImage = $request->image;
				$imageName = time().'.'.$uploadedImage->extension();
				$uploadedImage->storeAs($this->_uploadFolder, $imageName, 'public');
				$image = $this->_uploadFolder.'/'.$imageName;
			}

			$product = Product::create($request->all());
			$product->image = $image;
			$product->save();
			
			return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
			// Delete old Photo
			if( $product->image ) {
				Storage::disk('public')->delete( $product->image );
			}

			// update all
			$product->update($request->all());

			// Upload new image
			if( $request->image ) {
				$uploadedImage = $request->image;
				$imageName = time().'.'.$uploadedImage->extension();
				$uploadedImage->storeAs($this->_uploadFolder, $imageName, 'public');
				$product->image = $this->_uploadFolder.'/'.$imageName;
				$product->save();
			}

			return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
      $product->delete();
			return response()->json(null, 204);
    }
}
