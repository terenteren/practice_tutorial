@extends('main')

@section('content')
<br>
<div class="alert mycolor1" role="alert">월별 제품별 매출현황</div>

<script>
    function find_text() {
        form1.action="{{ route('crosstab.index') }}";
        form1.submit();
    }

    $(function() {
        $("#text1").datetimepicker({
            locale: "ko",
            format: "YYYY",
            viewMode: "years",
            defaultDate: moment()
        });

        $("#text1").on("dp.change", function (e) {
           find_text(); 
        });
    });
</script>

<form action="" name="form1">
    <div class="row">
        <div class="col-12" align="left">
            <div class="d-inline-flex">
                <div class="input-group input-group-sm date" id="text1">
                    <span class="input-group-text">날짜</span>
                    <input type="text" name="text1" size="4" value="{{ $text1 }}" class="form-control" onkeydown="if (event.keyCode == 13) { find_text(); }">
                    <span class="input-group-text">
                        <div class="input-group-addon">
                            <i class="far fa-calendar-alt fa-lg"></i>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>

<table class="table table-sm table-bordered table-hover mymargin5">
    <thead>
        <tr class="mycolor2">
            <th scope="col" width="49%">제품명</th>
            <th scope="col" width="5%">1월</th>
            <th scope="col" width="5%">2월</th>
            <th scope="col" width="5%">3월</th>
            <th scope="col" width="5%">4월</th>
            <th scope="col" width="5%">5월</th>
            <th scope="col" width="5%">6월</th>
            <th scope="col" width="5%">7월</th>
            <th scope="col" width="5%">8월</th>
            <th scope="col" width="5%">9월</th>
            <th scope="col" width="5%">10월</th>
            <th scope="col" width="5%">11월</th>
            <th scope="col" width="5%">12월</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($list as $row)
        <tr>
            <td align="left" class="mycolor3">{{ $row->product_name }}</td>
            <td align="rifht">{{ $row->s1==0 ? "" : number_format($row->s1) }}</td>
            <td align="rifht">{{ $row->s2==0 ? "" : number_format($row->s2) }}</td>
            <td align="rifht">{{ $row->s3==0 ? "" : number_format($row->s3) }}</td>
            <td align="rifht">{{ $row->s4==0 ? "" : number_format($row->s4) }}</td>
            <td align="rifht">{{ $row->s5==0 ? "" : number_format($row->s5) }}</td>
            <td align="rifht">{{ $row->s6==0 ? "" : number_format($row->s6) }}</td>
            <td align="rifht">{{ $row->s7==0 ? "" : number_format($row->s7) }}</td>
            <td align="rifht">{{ $row->s8==0 ? "" : number_format($row->s8) }}</td>
            <td align="rifht">{{ $row->s9==0 ? "" : number_format($row->s9) }}</td>
            <td align="rifht">{{ $row->s10==0 ? "" : number_format($row->s10) }}</td>
            <td align="rifht">{{ $row->s11==0 ? "" : number_format($row->s11) }}</td>
            <td align="rifht">{{ $row->s12==0 ? "" : number_format($row->s12) }}</td>
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