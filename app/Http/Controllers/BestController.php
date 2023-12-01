<?php

namespace App\Http\Controllers;

use App\Models\Gubun;
use App\Models\Product;
use App\Models\Jangbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BestController extends Controller
{
    public function index()
    {
        // $data['tmp'] = $this->qstring();

        $text1 = request('text1');
        if (!$text1) $text1 = date('Y-m-d', strtotime("-1 month")); // 오늘 기준 1달전 날짜

        $text2 = request('text2');
        if (!$text2) $text2 = date('Y-m-d');    // 오늘 날짜


        $data['text1'] = $text1;
        $data['text2'] = $text2;
        $data['list'] = $this->getlist($text1, $text2);

        $data['list_product'] = $this->getlist_product();   // 콤보상자용 제품정보
            
        return view('best.index', $data);
    }

    public function getlist($text1, $text2)
    {
        $result = Jangbu::leftjoin('products','jangbus.products_id', '=', 'products.id')
            ->select('products.name as product_name', DB::raw('count(jangbus.numi) as cnumo'))
            ->wherebetween('jangbus.writeday', array($text1, $text2))
            ->where('jangbus.io', '=', 1)
            ->orderby('cnumo', 'desc')
            ->groupby('products.name')
            ->paginate(5)->appends(['text1'=>$text1, 'text2'=>$text2]);
                
        return $result;
    }

    public function getlist_product()
    {
        $result = Product::orderby('name')->get();
        
        return $result;
    }


    public function qstring()
    {
        $text1 = request('text1') ? request('text1') : '';
        $page = request('page') ? request('page') : '1';

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }

}
