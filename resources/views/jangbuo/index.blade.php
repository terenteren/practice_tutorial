@extends('main')

@section('content')
<br>
<div class="alert mycolor1" role="alert">매출</div>

<script>
    function find_text() {
        form1.action="{{ route('jangbuo.index') }}";
        form1.submit();
    }

    $(function() {
        $("#text1").datetimepicker({
            locale: "ko",
            format: "YYYY-MM-DD",
            defaultDate: moment()
        });

        $("#text1").on("dp.change", function (e) {
           find_text(); 
        });
    });
</script>

<form action="" name="form1">
    <div class="row">
        <div class="col-3" align="left">
            <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="text1">
                    <span class="input-group-text">날짜</span>
                    <input type="text" name="text1" size="10" value="{{ $text1 }}" class="form-control" onkeydown="if (event.keyCode == 13) { find_text(); }">
                    <span class="input-group-text">
                        <div class="input-group-addon">
                            <i class="far fa-calendar-alt fa-lg"></i>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-9" align="right">
            <a href="{{ route('jangbuo.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <thead>
        <tr class="mycolor2">
            <th scope="col" width="10%">날짜</th>
            <th scope="col" width="20%">제품명</th>
            <th scope="col" width="30%">단가</th>
            <th scope="col" width="20%">수령</th>
            <th scope="col" width="20%">금액</th>
            <th scope="col" width="20%">비고</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($list as $row)
        <tr>
            <th scope="row">{{ $row->writeday }}</th>
            <td><a href="{{ route('jangbuo.show', $row->id) }}{{ $tmp }}">{{ $row->product_name }}</a></td>
            <th scope="row">{{ number_format($row->price) }}</th>
            <th scope="row">{{ number_format($row->numo) }}</th>
            <th scope="row">{{ number_format($row->prices) }}</th>
            <th scope="row">{{ $row->bigo }}</th>
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