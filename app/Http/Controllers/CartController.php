<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Order_history;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class CartController extends Controller
{
    //
    function show(){
      
        return view('cart.show');
    }
    
    function add($id){
        // Cart::destroy();
        $product = Product::find($id);     
        $userId = Auth::user()->id;          
        Cart::session($userId)->add([
            'id' => $product->id, 
            'name' => $product->name, 
            'quantity' => 1, 
            'price' => $product->price,
            'attributes' => array(
                'thumbnail' => $product->thumbnail,
            ),
        ]); 
        //  echo "<pre>";
        // print_r(Cart::getContent());
        return Redirect::back()->with('add_cart_success', 'Thêm thành công sản phẩm vào giỏ hàng');
        // return redirect('cart/show');
    }
    public function remove($id){
        $userId = Auth::user()->id;     
        Cart::session($userId)->remove($id);
        $response = [
            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.',
        ];
    
        return response()->json($response);
        // return redirect('cart/show');
    }
    function destroy(){
        $userId = Auth::user()->id;     
        Cart::session($userId)->clear();
        return redirect('cart/show');
    }

    function update(Request $request){
        // dd($request->all());
        $userId = Auth::user()->id;     
        $data = $request->get('quantity');
        // dd($data);
        foreach($data as $key => $val){
            Cart::session($userId)->update($key, [
                'quantity' => array(
                    'relative' => false,
                    'value' => $val,
                ),
            ]);
        }
        
        return redirect('cart/show');
    }
    
    function checkout(Request $request){
        $userId = Auth::user()->id; 
        $list_cart =  Cart::session($userId)->getContent();

        return view('cart.checkout', compact('list_cart'));
    }

    function payment(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'home_number' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward'=> 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Họ và tên',
                'email' => 'Địa chỉ email xác nhận đơn hàng',
                'phone' => 'Số điện thoai người nhận',
                'province' => 'Thành phố',
                'district' => 'Quận/huyện',
                'ward' => 'Xã/phường'
            ],
        );

        $user_id = Auth::user()->id;

        $prefix = 'VIETMART'; // Tiền tố mã đơn hàng (tùy chọn)
        $length = 6; // Độ dài mã đơn hàng (tùy chọn)
    
        // Tạo mã đơn hàng ngẫu nhiên
        $randomCode = Str::random($length);
    
        // Kết hợp tiền tố và mã đơn hàng ngẫu nhiên
        $orderCode = $prefix . $randomCode;
        $order = Order::create(
            [
                'code' => $orderCode,
                'user_id' => $user_id,
                'price' => Cart::session($user_id)->getTotal(),
            ]
        );

        foreach(Cart::session($user_id)->getContent() as $product){
            $owner_id = Product::find($product->id)->user_id;
            Order_detail::create(
                [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'total' => $product->price * $product->quantity,
                    'status_id' => 1,
                    'owner_id' => $owner_id,
                ]
            );

            Order_history::create(
                [
                    'user_id' => $user_id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'total' => $product->price * $product->quantity,
                    'status_id' => 1,
                ]
            );
        }
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'home_number' => $request->home_number,
            'phone' => $request->phone,
            'total' => Cart::session($user_id)->getTotal(),
            'cart' => Cart::session($user_id)->getContent(),
        ];
        Mail::to($request->email)->send(new OrderEmail($data));
        Cart::session($user_id)->clear();
        return view('cart.confirm_order');
    }

   function history(){
        $list_order_history = Order_history::with('product', 'status', 'user')->get();
        return view('cart.order_history', compact('list_order_history'));
   }
}
