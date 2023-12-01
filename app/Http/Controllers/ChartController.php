<?php

namespace App\Http\Controllers;

use App\Models\Gubun;
use App\Models\Product;
use App\Models\Jangbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
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
        $list = $this->getlist($text1, $text2);

        $str_label = "";
        $str_data = "";
        foreach($list as $row)
        {
            $str_label .= "'$row->gubun_name', ";   // "'음료', '맥주', '과일', ..."
            $str_data .= $row->cnumo . ',';         // "62, 25, 6, ..."
        }
        $data['str_label'] = $str_label;
        $data['str_data'] = $str_data;
            
        return view('chart.index', $data);
    }

    public function getlist($text1, $text2)
    {
        $result = Jangbu::leftjoin('products','jangbus.products_id', '=', 'products.id')
            ->leftjoin('gubuns', 'products.gubuns_id', '=', 'gubuns.id')
                ->select('gubuns.name as gubuns_name', DB::raw('count(jangbus.numo) as cnumo'))
                ->wherebetween('jangbus.writeday', array($text1, $text2))
                ->where('jangbus.io', '=', 1)
                ->orderby('cnumo', 'desc')
                ->groupby('gubuns.name')
                ->limit(14)
                ->paginate(14)->appends(['text1'=>$text1, 'text2'=>$text2]);
                    
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
