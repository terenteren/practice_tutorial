@extends('main')

@section('content')

<br>
<div class="alert mycolor1" role="alert">매입</div>

<script>
  $(function() {
      $("#writeday").datetimepicker({
          locale: "ko",
          format: "YYYY-MM-DD",
          defaultDate: moment()
      });
  });

  function select_product() 
  {
    var str;
    str = form1.sel_products_id.value;
    
    if (str == "") 
    {
      form1.products_id.value = "";
      form1.price.value = "";
      form1.prices.value = "";
    }
    else
    {
      str = str.split('^^');
      form1.products_id.value = str[0];
      form1.price.value = str[1];
      form1.prices.value = Number(form1.price.value) * Number(form1.numi.value);
    }
  }

  function cal_prices()
  {
    form1.prices.value = Number(form1.price.value) * Number(form1.numi.value);
    form1.bigo.focus();
  }
</script>

<form action="{{ route('jangbui.update', $row->id) }}{{ $tmp }}" method="post" name="form1">
  @csrf
  @method('PATCH')
  <table class="table table-sm table-bordered mymargin5">
    <tr>
      <td width="20%" class="mycolor2"><font color=""red>*</font> 날짜</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <div class="input-group input-group-sm date" id="writeday">
            <input type="text" name="writeday" size="10" value="{{ $row->writeday }}" class="form-control form-control-sm">
            <div class="input-group-text">
              <div class="input-group-addon">
                <i class="far fa-calendar-alt fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
        @error('writeday')
          {{ $message }}
        @enderror
      </td>
    </tr>
    <tr>
      <td width="20%" class="mycolor2"><font color=""red>*</font> 제품명</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="hidden" name="products_id" value="{{ old('products_id') }}">
          <select name="sel_products_id" id="sel_products_id" class="form-select form-=select-sm" onchange="select_product();">
            <option value="">선택하세요.</option>
            @foreach ($list as $row1)
              @php
                $t1 = $row1->id.'^^'.$row1->price;
                $t2 = $row1->name.'('.$row1->price.')';
              @endphp
              @if ($row->products_id == $row1->id)
                <option value="{{ $t1 }}" selected>{{ $t2 }}</option>
              @else
              <option value="{{ $t1 }}">{{ $t2 }}</option>
              @endif
            @endforeach
          </select>
        </div>
        @error('products_id')
          {{ $message }}
        @enderror
      </td>
    </tr>
    <tr>
      <td width="20%" class="mycolor2">단가</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="text" name="price" size="20" value="{{ $row->price }}" class="form-control form-control-sm" onchange="cal_prices();">
        </div>
      </td>
    </tr>
    <td width="20%" class="mycolor2">수량</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="text" name="numi" size="20" value="{{ $row->numi }}" class="form-control form-control-sm" onchange="cal_prices();">
        </div>
      </td>
    </tr>
    <td width="20%" class="mycolor2">금액</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="text" name="prices" size="20" value="{{ $row->prices }}" class="form-control form-control-sm" readonly>
        </div>
      </td>
    </tr>
    <td width="20%" class="mycolor2">비고</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="text" name="bigo" size="20" value="{{ $row->bigo }}" class="form-control form-control-sm">
        </div>
      </td>
    </tr>
  </table>

  <div align="center">
    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
  </div>
  
</form>


@endsection()