@extends('main')

@section('content')
<br>
<div class="alert mycolor1" role="alert">기간별 매출입 현황</div>

<script>
    function find_text() {
        form1.action="{{ route('gigan.index') }}";
        form1.submit();
    }

    $(function() {
        $("#text1").datetimepicker({
            locale: "ko",
            format: "YYYY-MM-DD",
            defaultDate: moment()
        });
        $("#text2").datetimepicker({
            locale: "ko",
            format: "YYYY-MM-DD",
            defaultDate: moment()
        });

        $("#text1").on("change.datetimepicker", function (e) {
           find_text(); 
        });
        $("#text2").on("change.datetimepicker", function (e) {
           find_text(); 
        });
    });

    function make_excel()
    {
        form1.action="{{ url('gigan/excel') }}";
        form1.submit();
    }
</script>

<form action="" name="form1">
    <div class="row">
        <div class="col-12" align="left">
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

            <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="text2">
                    <input type="text" name="text2" size="10" value="{{ $text2 }}" class="form-control" onkeydown="if (event.keyCode == 13) { find_text(); }">
                    <span class="input-group-text">
                        <div class="input-group-addon">
                            <i class="far fa-calendar-alt fa-lg"></i>
                        </div>
                    </span>
                </div>
            </div>
            &nbsp;
            <div class="d-inline-flex">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">제품명</span>
                    <select name="text3" class="form-control" onchange="find_text();">
                        <option value="0" selected>전체</option>
                        @foreach ($list_product as $row)
                            @if ($row->id == $text3)
                                <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                            @else
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-inline-flex">
                <input type="button" value="EXCEL" class="form-control btn btn-sm mycolor1" onclick="if (confirm('엑셀파일로 저장할까요?')) make_excel();">
            </div>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <thead>
        <tr class="mycolor2">
            <th scope="col" width="15%">날짜</th>
            <th scope="col" width="25%">제품명</th>
            <th scope="col" width="10%">단가</th>
            <th scope="col" width="10%">매입수량</th>
            <th scope="col" width="10%">매출수량</th>
            <th scope="col" width="15%">금액</th>
            <th scope="col" width="15%">비고</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($list as $row)
        @php
            $numi = $row->numi ? number_format($row->numi) : "";
            $numo = $row->numo ? number_format($row->numo) : "";
        @endphp
        <tr>
            <td scope="row">{{ $row->writeday }}</td>
            <td><a href="{{ route('jangbuo.show', $row->id) }}">{{ $row->product_name }}</a></td>
            <td scope="row">{{ number_format($row->price) }}</td>
            <th scope="row" class="mycolor3">{{ $numi }}</td>
            <td scope="row" class="mycolor3">{{ $numo }}</td>
            <td scope="row">{{ number_format($row->prices) }}</td>
            <td scope="row">{{ $row->bigo }}</td>
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