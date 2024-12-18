<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;

use Auth;
use Illuminate\Support\Carbon;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{

    public function ProductAll(){
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    public function ProductAdd(){
        $familys = Family::all();
        $unitMeasures = UnitMeasure::latest()->get();
        $taxRates = TaxRate::latest()->get();
        return view('backend.product.product_add', compact('familys','unitMeasures','taxRates'));
    }

    public function ProductStore(Request $request){
        if($request->file('profile_image')){
            $manager = new ImageManager(new Driver());
            $transformName = hexdec(uniqid()).".".$request->file('profile_image')->getClientOriginalExtension();
            $img=$manager->read($request->file('profile_image'));
            $img=$img->resize(200,200);
            $img->toJpeg(80)->save(base_path('public/backend/assets/images/product/'.$transformName));
            $save_url='/backend/assets/images/product/'.$transformName;
        }

        try{
            Product::insert([
                'code' => $request->code,
                'description' => $request->description,
                'family' => $request->product_family,
                'unit' => $request->product_unit,
                'taxRateCode' => $request->taxRateCode_Product,
                'image' => $save_url,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Product added successfully!', 
                'alert-type' => 'success'
            );
            return redirect()->route('product.all')->with($notification);
        } catch (\Exception $e){
            $notification = array(
                'message' => 'Product not added!' .$e->getMessage(), 
                'alert-type' => 'error'
            );
            if(file_exists($save_url)){
                unlink($save_url);
            }
            return redirect()->route('product.all')->with($notification);
        
        }
    }


    public function ProductEdit($id){
        $familys = Family::all();
        $unitMeasures = UnitMeasure::all();
        $taxRates = TaxRate::all();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('familys', 'unitMeasures', 'taxRates','product'));

    }

    public function ProductUpdate(Request $request){
        $product_id=$request->id;

        $product=Product::findOrFail($product_id);
        $oldImagePath = base_path('public'. $product->image);
        if ($request->file('profile_image')){
            $manager = new ImageManager(new Driver());
            $transformName = hexdec(uniqid()).".".$request->file('profile_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('profile_image'));
            $img = $img->resize(200,200);
            $newImagePath = base_path('public/backend/assets/images/product/'.$transformName);
            $img->toJpeg(80)->save($newImagePath);
            $save_url = '/backend/assets/images/product/'.$transformName;
        }   

        try{
            if($request->file('profile_image')){
                Product::findOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'image' => $save_url,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
                $notification = array(
                    'message' => 'Product updated successfully!', 
                    'alert-type' => 'success'
                );
                return redirect()->route('product.all')->with($notification);
            } else {
                Product::findOrFail($product_id)->update([
                    'code' => $request->code,
                    'description' => $request->description,
                    'family' => $request->product_family,
                    'unit' => $request->product_unit,
                    'taxRateCode' => $request->taxRateCode_Product,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
                $notification = array(
                    'message' => 'Product updated successfully!', 
                    'alert-type' => 'success'
                );
                return redirect()->route('product.all')->with($notification);
            }
        } catch(\Exception $e) {
            $notification = [
                'message' => 'Product not updated!' .$e->getMessage(), 
                'alert-type' => 'error'
            ];
            return redirect()->route('product.all')->with($notification);
        }
     

    }


    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        $imgPath = base_path('public'.$product->image);
        try{
            $product->delete();
            if(file_exists($imgPath)){
                unlink($imgPath);
            }
            $notification = array(
                'message' => 'Product deleted successfully!', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }catch(\Exception $e){
            $notification = [
                'message' => 'Product not deleted!' . $e->getMessage(), 
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    
    }

}
