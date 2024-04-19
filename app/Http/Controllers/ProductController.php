<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    
    public function ListProductByCategory(Request $request): JsonResponse
    {
        $data = Product::where('category_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductByRemark(Request $request): JsonResponse
    {
        $data = Product::where('remark', $request->remark)->with('brand', 'category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductByBrand(Request $request): JsonResponse
    {
        $data = Product::where('brand_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductSlider()
    {
        $data = ProductSlider::all();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ProductDetailsById(Request $request): JsonResponse
    {
        $data = ProductDetail::where('product_id', $request->id)->with('product','product.brand', 'product.category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListReviewByProduct(Request $request): JsonResponse
    {
        $data = ProductReview::where('product_id', $request->product_id)->with(['profile' => function($query) {
            $query->select('id', 'cus_name');
        }])->get();
        return ResponseHelper::Out('Success', $data, 200);
    }
}
