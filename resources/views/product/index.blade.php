@extends('main')

@section('content')
<br>
<div class="alert mycolor1" role="alert">제품</div>

<script>
    function find_text() {
        form1.action="{{ route('product.index') }}";
        form1.submit();
    }
</script>

<form action="" name="form1">
    <div class="row">
        <div class="col-3" align="left">
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="basic-addon1">이름</span>
                <input type="text" name="text1" value="{{ $text1 }}" class="form-control" placeholder="찾을 이름은?" onkeydown="if (event.keyCode == 13) { find_text(); }">
                <button type="button" class="btn mycolor1" onclick="find_text();">검색</button>
            </div>
        </div>
        <div class="col-9" align="right">
            <a href="{{ route('product.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
            <a href="{{ url('product/jaego') }}{{ $tmp }}" class="btn btn-sm mycolor1">재고계산</a>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <thead>
        <tr class="mycolor2">
            <th scope="col" width="10%">번호</th>
            <th scope="col" width="20%">구분명</th>
            <th scope="col" width="30%">제품명</th>
            <th scope="col" width="20%">단가</th>
            <th scope="col" width="20%">재고</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($list as $row)
        <tr>
            <th scope="row">{{ $row->id }}</th>
            <th scope="row">{{ $row->gubun_name }}</th>
            <td><a href="{{ route('product.show', $row->id) }}{{ $tmp }}">{{ $row->name }}</a></td>
            <th scope="row">{{ $row->price }}</th>
            <th scope="row">{{ $row->jaego }}</th>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col">
        {{ $list->links('mypagination') }}
    </div>
</div>

@endsection