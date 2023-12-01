@extends('main_nomenu')

@section('content')
<br>
<div class="alert mycolor1" role="alert">제품선택</div>

<script>
    function find_text() {
        form1.action="{{ route('findproduct.index') }}";
        form1.submit();
    }

    function SendProduct(id, name, price)
    {
        opener.form1.products_id.value = id;
        opener.form1.product_name.value = name;
        opener.form1.price.value = price;
        opener.form1.prices.value = Number(price) * Number(opener.form1.numo.value);
        self.close();
    }
</script>

<form action="" name="form1">
    <div class="row">
        <div class="col-6" align="left">
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="basic-addon1">이름</span>
                <input type="text" name="text1" value="{{ $text1 }}" class="form-control" placeholder="찾을 이름은?" onkeydown="if (event.keyCode == 13) { find_text(); }">
                <button type="button" class="btn mycolor1" onclick="find_text();">검색</button>
            </div>
        </div>
        <div class="col-6" align="right">
            
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
            <td>
                <a href="javascript:SendProduct( {{ $row->id }}, '{{ $row->name }}', {{ $row->price }} );">
                    {{ $row->name }}
                </a>
            </td>
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