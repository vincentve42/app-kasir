<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Soldout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    public function DashboardUi()
    {
        
        $productcount = Auth::user()->product->count();
        
        $total = 0;
        $totals = 0;
        $product_count = Auth::user()->product->count();
        $sold = Auth::user()->sold;
        $soldz = Product::where('user_id','=',Auth::user()->id)->orderBy('qty','desc')->first();
        $solz = Product::where('user_id','=',Auth::user()->id)->orderBy('qty','desc')->get();
        $data = Product::where('user_id','=',Auth::user()->id)->get();
        $count = 0;
        foreach($sold as $mantap)
        {
            $total += $mantap->price;
            $totals++;
        }
        if($product_count > 0)
        {
        $bro = array("productcount" => $productcount,"total" => $total, "most_sold" => $soldz->judul,"totals" => $totals);
        // Chart
        $data = Product::where('user_id', '=',Auth::id())->get(); 

            $labels = $data->pluck('judul')->toArray(); 
            $qtys = $data->pluck('qty')->toArray();   

            

        $chart = Chartjs::build()
            ->name("Penjualan")
            ->type("bar")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Penjualan",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => $qtys,
                ]
            ])
            ->options([
                
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Penjualan'
                    ]
                ]
            ]);
        }
        else
        {
             $chart = Chartjs::build()
            ->name("Penjualan")
            ->type("bar")
            ->size(["width" => 400, "height" => 200])
            ->labels(['Tidak Ada'])
            ->datasets([
                [
                    "label" => "Penjualan",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => [0],
                ]
            ])
            ->options([
                
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Penjualan'
                    ]
                ]
            ]);
        
             $bro = array("productcount" => 0,"total" => 0, "most_sold" => "Tidak Ada","totals" => 0);
        }
        
        return view('dashboard/index',compact('bro','solz','count','chart'));
    }
    public function NextPage($count)
    {
        
        $cekadaproductkaga = Auth::user()->product->skip($count)->take(5)->count();
        $product = Auth::user()->product->skip($count)->take(5);
        $page = session()->get('page');
        if(!isset($page))
        {
            $page = 1;
        }
        
        if($cekadaproductkaga == 0)
        {
            return redirect()->back();
        }
        if($cekadaproductkaga > 0)
        {
            $page += 1;
            session()->put('page',$page);
        }
        return view('dashboard/product',compact("product","count", "cekadaproductkaga",'page'));
    }
    public function SearchName(Request $request)
    {
        $count = 0;
        $product = Auth::user()->product->where('judul', "=",$request->name);
        $page = 1;
        return view('dashboard/product',compact('product','count','page'));

    }
     public function SearchProduct(Request $request)
    {
        $count = 0;
        $product = Auth::user()->product->where('judul', "=",$request->name);
        $page = 1;
        return view('dashboard/kasir',compact('product'));

    }
    public function BackPage($count)
    {
        $count -= 5;
        $product = Auth::user()->product->skip($count)->take(5);
       
        $page = session()->get('page');
        if($page > 0)
        {
            $page -= 1;
            session()->put('page',$page);
        }
        
        session()->put('page',$page);
        
        return view('dashboard/product',compact("product","count"));

    }
    public function ViewCart()
    {
        return view('dashboard/cart');
    }
    public function ProductUi()
    {
        $take = 5;
        $page = session()->get('page');
        
        if(!isset($count))
        {
            $count = 0;   
            
        }
        if(!isset($page))
        {
            $page = 1;
            session()->put('page',$page);
        }
        
    
        $product = Auth::user()->product->skip($count)->take($take);
        $count += 1;
        
        return view('dashboard/product',compact("product","count","page"));
    }
    public function AddProduct(Request $request)
    {
        $request->validate([
            "judul" => "required",
            "price" => "required",
            'image' => 'required|mimes:png,jpeg,jpg,webp',


            
        ]);
        try
        {
            $product = new Product;
            $product->user_id = Auth::user()->id;
            $product->judul = $request->judul;
            $product->price= $request->price;
            
            $imgname = uniqid(). time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('image'), $imgname);
            $product->image = "image/".$imgname;
            $product->save();
            return redirect()->route('ProductUi');
        }
        catch(Exception $e)
        {
            return $e;
        }

    }
    public function DeleteConfirm($id)
    {
        
        $cek = Auth::user()->product->find($id)->count();
        
        
        if($cek < 1)
        {
            return redirect()->back();
        }
        else
        {
             $selected_product = Auth::user()->product->find($id);
             return view('dashboard/delete-product',compact('selected_product'));
        }
       
    }
    public function DeleteConfirmSold($id)
    {
        
        $cek = Auth::user()->sold->find($id);
      
        $cek->delete();

        return redirect()->back();
       
    }
    public function DeleteProduct($id,Request $request)
    {
        try
        {
            $gg = Auth::user()->product->find($id);
            $gg->delete();
            return redirect()->route('ProductUi');
        }
        catch(Exception $e)
        {
            return $e;
        }
        
    }
    public function EditProductUi($id)
    {
        $cek = Auth::user()->product->find($id)->count();
        if($cek < 1)
        {
            return redirect()->back();
        }
        else
        {
             $single_product = Auth::user()->product->find($id);
             return view('dashboard/editproduct',compact('single_product'));
        }
       
    }
     public function EditProduct($id, Request $request)
    {
        try
        {
            $product_edit = Auth::user()->product->find($id);
            if($request->judul == "")
            {
                $new_judul = $product_edit->judul;
            }
            else if($request->judul != "")
            {
                $new_judul = $request->judul;
            }   
            if($request->price == "")
            {
                $new_price = $product_edit->price;
            }
            else if($request->price != "")
            {
                $new_price= $request->price;
            }
            if(!$request->hasFile('Image'))
            {
                $new_image = $product_edit->image;
            }
            else if($request->hasFile('Image'))
            {
                 $imgname = uniqid(). time() . "." . $request->file('image')->getClientOriginalExtension();
                 $request->file('image')->move(public_path('image'), $imgname);
                 $new_image = "image/".$imgname;
            }
            $product_edit->judul = $new_judul;
            $product_edit->price = $new_price;
            $product_edit->image = $new_image;
            $product_edit->save();
            return redirect()->route('ProductUi');
            
        }
        catch(Exception $e)
        {
            return $e;
        }
       
    }
    public function CashierUi()
    {
        $product = Auth::user()->product;
        return view('dashboard/kasir',compact("product"));
    }
    public function AddToCart($id)
    {
        $product = Auth::user()->product->find($id);

        if (!$product) {

            abort(404);
        }

        $cart = session()->get('cart');

        if (!$cart) {

            $cart = [
                $id => [
                    "id" => $product->id,
                    "name" => $product->judul,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->image
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$id] = [
            "id" => $product->id,
            "name" => $product->judul,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->image
        ];

        session()->put('cart', $cart);
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Product added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function ClearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }
    public function PlaceOrder()
    {
        $cart = session()->get('cart');
        foreach($cart as $id => $details)
        {
            try
            {
                $sold = new Soldout;
                $sold->price = $details['price'];
                $sold->product_id = $details['id'];
                $sold->name = $details['name'];
                $sold->user_id = Auth::user()->id;
                $sold->save();
                $product = Product::find($sold->product_id);
                $product->qty += 1;
                $product->saveQuietly();

            }
            catch(Exception $e)
            {
                return $e;
            }
        }
        session()->forget('cart');
        return redirect()->back();
        
    }
    public function SoldUi()
    {
        
        $product = Product::where('user_id','=',Auth::user()->id)->orderBy('qty','desc')->take(10)->get();
        $take = 5;
        if(!isset($count))
        {
            $count = 0;   
            
        }
        $page = 1;
        $sold = Auth::user()->sold->take(15)->skip($count);
        return view('dashboard/sold',compact('sold',"count","product",'page'));
    }
    public function NextSold($count)
    {
        $sold = Auth::user()->sold->skip($count)->take(15);
        $solds = Auth::user()->sold->skip($count)->take(15)->count();
        $page = session()->get('page');
        $product = Product::where('user_id','=',Auth::user()->id)->orderBy('qty','desc')->take(10)->get();
        if(!isset($page))
        {
            $page = 1;
        }
        
        if($solds == 0)
        {
            return redirect()->back();
        }
        if($solds > 0)
        {
            $page += 1;
            session()->put('page',$page);
        }
        
        return view('dashboard/sold',compact("count", "sold",'page','product'));
    }
     public function BackSold($count)
    {
        $count -= 5;
        $product = Auth::user()->product->skip($count)->take(5);
        $page = session()->get('page');
        if(!isset($page))
        {
            $page = 1;
            session()->put('page',$page);
        }
        $page = session()->get('page');
        return view('dashboard/sold',compact("product","count","page"));

    }
}
