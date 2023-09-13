<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //
    function detail($id){
        $product = Product::find($id);
        $tb_rating = Rating::where('product_id', $id)->avg('rating_value');
        $count_review = Comment::where('product_id', $id)->count();
        $list_review = Comment::with('user', 'product')->where('product_id', $id)->get();
        $list_rating = Rating::with('user', 'product')->where('product_id', $id)->get();
        $focusReview = request('focus') == true ? true : false;

        if ($product) {
            $inventories = $product->inventories; // inventories là tên phương thức đã định nghĩa trong mô hình Product
        
            // Lặp qua danh sách inventory để lấy size và hiển thị thông tin
            foreach ($inventories as $inventory) {
                $size = $inventory->size; // Lấy size thông qua mối quan hệ size() trong inventory
                if ($size) {
                    $sizeNames[] = $size->name;
                }
                $color = $inventory->color;
                if ($color) {
                    $colorNames[] = $color->name;
                }
            }
        }

        return view('product.detail', compact('product', 'tb_rating', 'count_review', 'list_review', 'list_rating', 'focusReview', 'sizeNames', 'colorNames'));
    }

    function review($id, Request $request){
        $user_id = Auth::user()->id;

        $check = Comment::where('user_id', $user_id)->where('product_id', $id)->first();
        if ($check) {
            // Nếu đã nhận xét rồi, bạn có thể hiển thị thông báo hoặc thực hiện các hành động khác tùy ý
            return Redirect::back()->with('check_review', 'Bạn đã có nhận xét về sản phẩm này');
        }
        Comment::create(
            [
                'content' => $request->content,
                'user_id' => $user_id,
                'product_id' => $id,
                'status_comment_id' => 1,
            ]
        );
        Rating::create(
            [
                'rating_value' => $request->rating,
                'user_id' => $user_id,
                'product_id' => $id,
            ]
        );
        return Redirect::back()->with('success_review', 'Cảm ơn bạn đã nhận xét sản phẩm của chúng tôi');
    }
}
