@extends('main')

@section('content')
<br>
<div class="alert mycolor1" role="alert">사용자</div>

<script>
    function find_text() {
        form1.action="{{ route('member.index') }}";
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
            <a href="{{ route('member.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <thead>
        <tr class="mycolor2">
            <th scope="col" width="10%">번호</th>
            <th scope="col" width="20%">아이디</th>
            <th scope="col" width="20%">암호</th>
            <th scope="col" width="20%">이름</th>
            <th scope="col" width="20%">전화</th>
            <th scope="col" width="10%">등급</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($list as $row)
        @php
            $tel1 = trim(substr($row->tel, 0, 3));
            $tel2 = trim(substr($row->tel, 3, 4));
            $tel3 = trim(substr($row->tel, 7, 4));
            $tel = $tel1 . "-" . $tel2 . "-" . $tel3;
            $rank = $row->rank==0 ? "직원" : "관리자";
        @endphp
        <tr>
            <th scope="row">{{ $row->id }}</th>
            <td><a href="{{ route('member.show', $row->id) }}{{ $tmp }}">{{ $row->name }}</a></td>
            <td>{{ $row->uid }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $tel }}</td>
            <td>{{ $rank }}</td>
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