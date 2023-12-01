<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->get("rank")!=1) return redirect("/");

        $data['tmp'] = $this->qstring();

        $text1 = request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('member.index', $data);
    }

    public function getlist($text1)
    {
        $result = Member::where('name', 'like', '%' . $text1 . '%')
                    ->orderBy('id')->paginate(5)->appends( ['text1' => $text1 ] );
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $data['tmp'] = $this->qstring();

        return view('member.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $row = new Member;
        $this->save_row($request, $row);

        $tmp = $this->qstring();
        return redirect('member' . $tmp);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['tmp'] = $this->qstring();

        $data['row'] = Member::find($id);
        return view('member.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['tmp'] = $this->qstring();

        $data['row'] = Member::find($id);
        return view('member.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tmp = $this->qstring();

        $row = Member::find($id);
        $this->save_row($request, $row);

        return redirect('member' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tmp = $this->qstring();
        Member::find($id)->delete();

        return redirect('member' . $tmp);
    }

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'uid'   => 'required|max:20',
            'pwd'   => 'required|max:20',
            'name'   => 'required|max:20'
        ],
        [
            'uid.required'  => '아이디는 필수입력입니다.',
            'pwd.required'  => '암호는 필수입력입니다.',
            'name.required'  => '이름은 필수입력입니다.',
            'uid.max'  => '20자 이내입니다.',
            'pwd.max'  => '20자 이내입니다.',
            'name.max'  => '20자 이내입니다.',
        ]);

        $tel1 = $request->input("tel1");
        $tel2 = $request->input("tel2");
        $tel3 = $request->input("tel3");
        $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);

        $row->uid = $request->input("uid");
        $row->pwd = $request->input("pwd");
        $row->name = $request->input("name");
        $row->tel = $tel;
        $row->rank = $request->input("rank");

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
