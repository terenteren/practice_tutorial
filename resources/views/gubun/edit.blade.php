@extends('main')

@section('content')

@php
    $tel1 = trim(substr($row->tel, 0, 3));
    $tel2 = trim(substr($row->tel, 3, 4));
    $tel3 = trim(substr($row->tel, 7, 4));
    $rank = $row->rank==0 ? "직원" : "관리자";
@endphp

<br>
<div class="alert mycolor1" role="alert">구분</div>

<form action="{{ route('gubun.update', $row->id) }}{{ $tmp }}" method="post" name="form1">
  @csrf
  @method('PATCH')
  <table class="table table-sm table-bordered mymargin5">
    <tr>
      <td width="20%" class="mycolor2">번호</td>
      <td width="80%" align="left">{{ $row->id }}</td>
    </tr>
    <tr>
      <td width="20%" class="mycolor2"><font color=""red>*</font> 이름</td>
      <td width="80%" align="left">
        <div class="d-inline-flex">
          <input type="text" name="name" size="20" maxlength="20" value="{{ $row->name }}" class="form-control form-control-sm">
        </div>
        @error('name')
          {{ $message }}
        @enderror
      </td>
    </tr>
  </table>

  <div align="center">
    <input type="submit" value="저장" class="btn btn-sm mycolor1">&nbsp;
    <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
  </div>
  
</form>


@endsection()