<?php

namespace App\Http\Controllers;

use App\Models\Gubun;
use App\Models\Product;
use App\Models\Jangbu;
use Illuminate\Http\Request;

class JangbuoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tmp'] = $this->qstring();

        $text1 = request('text1');
        if (!$text1) $text1 = date('Y-m-d');

        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
            
        return view('jangbuo.index', $data);
    }

    public function getlist($text1)
    {
        $result = Jangbu::leftjoin('products','jangbus.products_id', '=', 'products.id')
                    ->select('jangbus.*', 'products.name as product_name')
                    ->where('jangbus.io', '=', 1)
                    ->where('jangbus.writeday', '=', $text1)
                    ->orderby('jangbus.id', 'desc')
                    ->paginate(5)->appends(['text1'=>$text1]);
                    
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $data['list'] = $this->getlist_product();

        $data['tmp'] = $this->qstring();

        return view('jangbuo.create', $data);
    }

    public function getlist_product()
    {
        $result = Product::orderby('name')->get();
        
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $row = new Jangbu;
        $this->save_row($request, $row);

        $tmp = $this->qstring();
        return redirect('jangbuo' . $tmp);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['tmp'] = $this->qstring();

        $data['row'] = Jangbu::leftjoin('products', 'jangbus.products_id', '=', 'products.id')
                ->select('jangbus.*', 'products.name as product_name')
                ->where('jangbus.id', '=', $id)->first();

        return view('jangbuo.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['list'] = $this->getlist_product();

        $data['tmp'] = $this->qstring();

        $data['row'] = Jangbu::leftjoin('products', 'jangbus.products_id', '=', 'products.id')
        ->select('jangbus.*', 'products.name as product_name')
        ->where('jangbus.id', '=', $id)->first();

        return view('jangbuo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tmp = $this->qstring();

        $row = Jangbu::find($id);
        $this->save_row($request, $row);

        return redirect('jangbuo' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tmp = $this->qstring();
        Jangbu::find($id)->delete();

        return redirect('jangbuo' . $tmp);
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'writeday'   => 'required|date',
            'products_id'   => 'required'
        ],
        [
            'writeday.required'  => '날짜는 필수입력입니다.',
            'products_id.required'  => '제품명은 필수입력입니다.',
            'writeday.date'  => '날짜형식이 잘못되었습니다.'
        ]);

        $row->io = 1;
        $row->writeday = $request->input("writeday");
        $row->products_id = $request->input("products_id");
        $row->price = $request->input("price");
        $row->numi = 0;
        $row->numo = $request->input("numo");
        $row->prices = $request->input("prices");
        $row->bigo = $request->input("bigo");

        $row->save();
    }


    public function qstring()
    {
        $text1 = request('text1') ? request('text1') : '';
        $page = request('page') ? request('page') : '1';

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }

}
