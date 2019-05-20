@extends('master')

@section('title-bar')
    @foreach ($versions as $version)
    @foreach ($version->kegiatan as $kegiatan)
    @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
       {{$kegiatan->nama_kegiatan}}
    @endif
    @endforeach
    @endforeach
@endsection

@section('right_title')
@foreach ($versions as $version)
@foreach ($version->kegiatan as $kegiatan)
@if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
    <li class="active">{{$kegiatan->nama_kegiatan}}</li>
@endif
@endforeach
@endforeach
@endsection

@section('add-css')
<!-- DataTables -->
   <link rel="stylesheet" href="{{url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
   <!-- Form -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
 @endsection
@section('content')
<br/>
  <div class="col-md-13">
    @if (session('message_success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><h4><i class="icon fa fa-check"></i> Sukses!</strong></h4>
            {{ session('message_success') }}
        </div>
    @endif
       <div class="box box-default">
        <div class="box-header with-border" style="margin: 1em 0 0 1em;">
          <strong class="box-title" >
            @foreach ($versions as $version)
              @foreach ($version->kegiatan as $kegiatan)
                @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                  {{strtoupper($kegiatan->nama_kegiatan)}}
                @endif
              @endforeach
            @endforeach
          </strong><br/>
          <strong class="card-title">Data version {{$version->version}}</strong>
          <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&emsp;Add
      </button>
        </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="10">No.</th>
                  <th>Uraian Kegiatan</th>
                  <th>Satuan</th>
                  <th>Besaran Bruto Maksimum (Rp)</th>
                  <th width="40"></th>
                </tr>
                </thead>
               <tbody>
                @foreach ($versions as $version)
                @foreach ($version->kegiatan as $kegiatan)
                @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                @foreach ($kegiatan->kategori as $key => $kategori) 
                    <tr>
                      <td>
                        {{$key+1}}. 
                      </td>
                    <th>{{ $kategori->kategori_kegiatan}}</th>
                    <td></td>
                    <td></td>
                      <td> 
                        <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate1({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#show-modal1"> | </i>
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate1({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#edit-modal1"> </i>
                        </td>
                    </tr>
                    @foreach ($kategori->uraian as $key2 => $uraian)
                    <tr>
                      <td></td>
                      <td>
                        @php
                          $i = chr($key2+97);
                        @endphp
                        &emsp;&ensp;{{$i}}. {{ $uraian->uraian_kegiatan}}
                      </td>
                      <td>
                          {{ $uraian->satuan}}
                      </td>
                      @if($uraian->var1 == null)
                      <td>
                      </td>
                      @else
                      <td>
                      {{number_format($uraian->var1)}}</td>
                      @endif 
                      <td>
                          <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate2({{ $uraian->id }},{{$uraian->kode_tabel}})" data-target="#show-modal2"> | </i> 
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2({{ $uraian->id }},{{$uraian->kode_tabel}}) "data-target="#edit-modal2"> </i>
                      </td>
                    </tr>
                    @foreach ($uraian->sub1 as $sub1)
                      <tr> 
                        <td></td>
                        <td>
                          &emsp;&emsp;&emsp;&emsp;{{ $sub1->uraian_kegiatan}}
                        </td>
                        
                        <td>
                            {{ $sub1->satuan}}
                        </td>
                        @if($sub1->var1 == null)
                        <td>
                        </td>
                        @else
                        <td>
                          {{number_format($sub1->var1)}}</td>
                        @endif 
                        <td>
                          <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate3({{ $sub1->id }},{{$sub1->kode_tabel}})" data-target="#show-modal3"> | </i>
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate3({{ $sub1->id }},{{$sub1->kode_tabel}})" data-target="#edit-modal3"> </i>
                        </td>
                      </tr>
                        @endforeach
                        @endforeach 
                      @if(strpos('$penjelasan->penjelasan', '0')!==false)
                      @else
                      <tr> 
                          <td></td>
                          <td><strong>Penjelasan:</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      @endif
                      @foreach($kategori->penjelasan as $penjelasan)
                        <tr>
                          <td></td>
                          <td>
                          <ul>
                            <li>
                              {{$penjelasan->penjelasan}}
                            </li>
                          </ul>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                          <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate4({{ $penjelasan->id }},{{$penjelasan->kode_tabel}})" data-target="#show-modal4"> | </i>
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate4({{ $penjelasan->id }},{{$penjelasan->kode_tabel}})" data-target="#edit-modal4"> </i>
                        </td>
                        </tr>
                        @endforeach  

                      @endforeach
                      @endif
                    @endforeach
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th width="10">No.</th>
                  <th>Uraian Kegiatan</th>
                  <th>Satuan</th>
                  <th>Besaran Bruto Maksimum (Rp)</th>
                  <th width="40"></th>
                </tr>
              </tfoot>
              </table>
          </br/>
        </div>
      </div>
      </div>

<!--Add Modal-->
        <div id="addModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add</h4>
              </div>
              <div class="modal-body">
                <select class="styled-select semi-square" style="width:200px" id="pilihopsi">
                  <option value="0">Pilih opsi</option>
                  <option value="1">Kategori</option>
                  <option value="2">Uraian</option>
                  <option value="3">Sub Uraian</option>
                  <option value="4">Penjelasan</option>
                </select>
                <input type="button" name="submitpilih" id="submitpilih" class="btn btn-primary" value="Add"/>

             <div class="form-group" id="form-kategori">
                  <br/>
                  @foreach ($version->kegiatan as $kegiatan)
                    @foreach ($kegiatan->kategori as $kategori)
                  @endforeach
                  @endforeach
                <form action="{{url('/data/add', $kategori->kode_tabel)}}" method="POST"> 
                  {{csrf_field()}} 
             <div class="form-group">
              <select class="form-control select2" style="width:500px" name="kegiatan_id" required>
                <option></option>
                @foreach ($versions as $version)
                  @foreach ($version->kegiatan as $kegiatan)
                    @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                      <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</option>
                    @endif
                @endforeach
              @endforeach
              </select>  
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Bagian</label>
                  <div class="col-sm-9">
                    <input type="text" style="border: none; box-shadow: none;" name="kode_bagian" value="{{$kode_bagian_kategori}}" class="form-control" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kategori</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3" id="kategori_kegiatan" name="kategori_kegiatan" placeholder="Kategori Kegiatan" required></textarea>
                  </div>
                </div>
              </div>
                <br/><br/>
              <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Add" /> 
              </div>
            </form>
          </form>
          </div>

          <div class="form-group" id="form-uraian">
                  <br/>
                  @foreach ($version->kegiatan as $kegiatan)
                    @foreach ($kegiatan->uraian as $uraian)
                  @endforeach
                  @endforeach
                <form action="{{url('/data/add', $uraian->kode_tabel)}}" method="POST">
                  {{csrf_field()}} 
                    <div class="form-group">
                      <select class="form-control select2" style="width:500px" name="kategori_kegiatan" required>
                        <option></option>
                        @foreach ($versions as $version)
                         @foreach ($version->kegiatan as $kegiatan)
                         @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                          @foreach($kegiatan->kategori as $kategori)
                             <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                          @endforeach
                          @endif
                        @endforeach
                      @endforeach
                      </select>  
                    </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Uraian</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="uraian_kegiatan" name="uraian_kegiatan" placeholder="Uraian Kegiatan" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Satuan</label>
                  <div class="col-sm-10">
                    <input type="text" name="satuan" placeholder="Satuan" class="form-control" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bruto</label>
                  <div class="col-sm-10">
                    <input type="number" name="var1" placeholder="Besaran Bruto Maksimum (Rp)" class="form-control" required />
                  </div>
                </div>
                <br/><br/>
              </div>
              <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Add" /> 
              </div>
            </form>
          </form>
          </div>

         

         <div class="form-group" id="form-sub1">
          <br/>
          @foreach ($version->kegiatan as $kegiatan)
            @foreach ($kegiatan->uraian as $uraian)
            @foreach ($uraian->sub1 as $sub1)
            @endforeach
            @endforeach
          @endforeach
        <form action="{{url('/data/add', $sub1->kode_tabel)}}" method="POST"> 
          {{csrf_field()}} 
          <div class="form-group">
            <select name="list_kategori_kegiatan" class="form-control select2"  style="width:500px" id="list_kategori_kegiatan">
              <option value=""></option>
              @foreach($versions as $version)
                @foreach($version->kegiatan as $kegiatan)
                @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                @foreach($kegiatan->kategori as $kategori)
                    <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                @endforeach 
                @endif
              @endforeach
            @endforeach
            </select>
          </div>
            <div class="form-group">  
            <select class="form-control selecturaian" name="list_uraian_kegiatan" style="width:500px" id="list_uraian_kegiatan">
              {{-- <option value="1">yeyeyey</option>--}}
              </select>  
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Uraian</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="uraian_kegiatan" name="uraian_kegiatan" placeholder="Uraian Kegiatan" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Satuan</label>
                  <div class="col-sm-10">
                    <input type="text" name="satuan" placeholder="Satuan" class="form-control" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bruto</label>
                  <div class="col-sm-10">
                    <input type="number" name="var1" placeholder="Besaran Bruto Maksimum (Rp)" class="form-control" required />
                  </div>
                </div>
                <br/><br/>
              </div>
              <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Add" /> 
              </div>
            </div>
            </form>
          </form>
          </div>

    <div class="form-group" id="form-penjelasan">
                  <br/>
                  @foreach ($version->penjelasan as $penjelasan)
                  @endforeach
                <form action="{{url('/data/add', $penjelasan->kode_tabel)}}" method="POST">
                  {{csrf_field()}} 
                    <div class="form-group">
                      <select class="form-control select2" style="width:500px" name="penjelasan_kategori" required>
                        <option></option>
                        @foreach ($versions as $version)
                         @foreach ($version->kegiatan as $kegiatan)
                         @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                          @foreach($kegiatan->kategori as $kategori)
                             <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                          @endforeach
                          @endif
                        @endforeach
                      @endforeach
                      </select>  
                    </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Version</label>
                  <div class="col-sm-10">
                    <input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="version" name="version" value="{{$version->id}}" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Penjelasan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" rows="3" id="penjelasan" name="penjelasan" placeholder="Penjelasan" required></textarea>
                  </div>
                </div>
                <br/><br/>
              </div>
              <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Add" /> 
              </div>
            </form>
          </form>
          </div>
          </div>
          </div>
        </div>
      </div>
    </div>

<!-- Show Modal -->
  <div class="modal fade" id="show-modal1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="id" name="id" disabled> </td>
                  </tr>
                  <tr>
                    <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Uraian Kegiatan</th>
                    <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                    <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="kategori" name="kategori" disabled></textarea> </td>
                  </tr>
                </table>
              </div>              
              </div>
            </div>
          </div>
        </div>
    </div>

<div class="modal fade" id="show-modal2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="id2" name="id2" disabled> </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Kategori</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="kategori2" name="kategori2" disabled></td>
                  </tr>
                 <tr>
                    <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Uraian Kegiatan</th>
                    <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                    <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="uraian" name="uraian" disabled></textarea> </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Satuan</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="satuan" name="satuan" disabled></td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Bruto</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="var1" name="var1" disabled></td>
                  </tr>
                </table>
              </div>              
              </div>
            </div>
          </div>
        </div>
    </div>

<div class="modal fade" id="show-modal3">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Data Details</h4>
            </div>
            <div class="modal-body">
            <div class="box-body">
              <table border="0">
                <tr>
                  <th class="col-sm-3 control-label">ID</th>
                  <td width="10">:</td>
                  <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="id3" name="id3" disabled> </td>
                </tr>
                <tr>
                  <th class="col-sm-3 control-label">Uraian</th>
                  <td width="10">:</td>
                  <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="uraian_id" name="uraian_id" disabled></td>
                </tr>
               <tr>
                  <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Uraian Kegiatan</th>
                  <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                  <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="sub1_uraian3" name="sub1_uraian3" disabled></textarea> </td>
                </tr>
                <tr>
                  <th class="col-sm-3 control-label">Satuan</th>
                  <td width="10">:</td>
                  <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="sub1_satuan3" name="sub1_satuan3" disabled></td>
                </tr>
                <tr>
                  <th class="col-sm-3 control-label">Bruto</th>
                  <td width="10">:</td>
                  <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="sub1_var1" name="sub1_var1" disabled></td>
                </tr>
              </table>
            </div>              
            </div>
          </div>
        </div>
      </div>
  </div>

<div class="modal fade" id="show-modal4">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="id4" name="id4" disabled> </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Kategori</th>
                    <td width="10">:</td>
                    <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="kategori4" name="kategori4" disabled></td>
                  </tr>
                 <tr>
                    <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Penjelasan</th>
                    <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                    <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="penjelasan4" name="penjelasan4" disabled></textarea> </td>
                  </tr>
                </table>
              </div>              
              </div>
            </div>
          </div>
        </div>
    </div>

<!-- Edit Modal -->
 <div class="modal fade" id="edit-modal1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <form action="{{url('/data/update', $kategori->kode_tabel)}}" method="POST">
              {{csrf_field()}} 
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_id" name="edit_id" required></td>
                  </tr>
                  <br/>
                  <tr>
                    <th class="col-sm-3 control-label">Uraian Kegiatan</th>
                    <td width="10">:&ensp;</td>
                    <td>
                    <textarea class="form-control" rows="3" id="kategori_kegiatan1" name="kategori_kegiatan1" required></textarea>
                    </td>
                  </tr>
                </table>
              </div>              
              </div>
               <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update" /> 
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>
<div class="modal fade" id="edit-modal2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <form action="{{url('/data/update', $uraian->kode_tabel)}}" method="POST">
              {{csrf_field()}} 
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_id2" name="edit_id2" required></td>
                  </tr>
                  <br/>
                  <tr>
                    <th class="col-sm-3 control-label">Kategori</th>
                    <td width="10">:</td>
                    <td>
                    <div class="form-group">
                      <select class="form-control select2" style="width:385px" name="edit_kategori2" id="edit_kategori2" required>
                        <option></option>
                        @foreach($versions as $version)
                          @foreach($version->kegiatan as $kegiatan)
                          @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                           @foreach($kegiatan->kategori as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                          @endforeach
                          @endif
                         @endforeach
                        @endforeach
                      </select>  
                    </div>
                  </td>
                  </tr>
                  <tr>
                    <th class="col-sm-4 control-label">Uraian Kegiatan</th>
                    <td width="10">:&ensp;</td>
                    <td>
                    <textarea class="form-control" rows="3" id="uraian_kegiatan2" name="uraian_kegiatan2" required></textarea>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Satuan</th>
                    <td width="10">:</td>
                    <td>
                    <input type="text" class="form-control" id="satuan2" name="satuan2" placeholder="Satuan" required>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Bruto</th>
                    <td width="10">:</td>
                    <td>
                    <input type="number" class="form-control" id="edit_var1" name="edit_var1" placeholder="Bruto" required>
                    </td>
                  </tr>
                </table>
              </div>              
              </div>
               <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update" /> 
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>

<div class="modal fade" id="edit-modal3">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <form action="{{url('/data/update', $sub1->kode_tabel)}}" method="POST">
              {{csrf_field()}} 
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_id3" name="edit_id3" required></td>
                  </tr>
                  <br/>
                  <tr>
                    <th class="col-sm-3 control-label">Uraian</th>
                    <td width="10">:</td>
                    <td>
                    <div class="form-group">
                      <select class="form-control select2" style="width:385px" name="uraian3" id="uraian3" required>
                        <option></option>
                        @foreach($versions as $version)
                          @foreach($version->kegiatan as $kegiatan)
                          @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                          @foreach($kegiatan->uraian as $uraian)
                            <option value="{{$uraian->id}}">{{$uraian->uraian_kegiatan}}</option>
                          @endforeach
                          @endif
                          @endforeach
                        @endforeach
                      </select>  
                    </div>
                  </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Uraian Kegiatan</th>
                    <td width="10">:</td>
                    <td>
                    <textarea class="form-control" rows="3" id="uraian_kegiatan3" name="uraian_kegiatan3" required></textarea>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Satuan</th>
                    <td width="10">:</td>
                    <td>
                    <input type="text" class="form-control" id="satuan3" name="satuan3" placeholder="Satuan" required>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-sm-3 control-label">Bruto</th>
                    <td width="10">:</td>
                    <td>
                    <input type="number" class="form-control" id="sub1_edit_var1" name="sub1_edit_var1" placeholder="Bruto" required>
                    </td>
                  </tr>
                </table>
              </div>              
              </div>
               <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update" /> 
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>

<div class="modal fade" id="edit-modal4">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Details</h4>
              </div>
              <div class="modal-body">
              <form action="{{url('/data/update', $penjelasan->kode_tabel)}}" method="POST">
              {{csrf_field()}} 
              <div class="box-body">
                <table border="0">
                  <tr>
                    <th class="col-sm-3 control-label">ID</th>
                    <td width="10">:</td>
                    <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_id4" name="edit_id4" required></td>
                  </tr>
                  <br/>
                  <tr>
                    <th class="col-sm-3 control-label">Kategori</th>
                    <td width="10">:</td>
                    <td>
                    <div class="form-group">
                      <select class="form-control select2" style="width:385px" name="edit_kategori4" id="edit_kategori4" required>
                        <option></option>
                        @foreach($versions as $version)
                          @foreach($version->kegiatan as $kegiatan)
                          @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                           @foreach($kegiatan->kategori as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                          @endforeach
                          @endif
                         @endforeach
                        @endforeach
                      </select>  
                    </div>
                  </td>
                  </tr>
                  <tr>
                    <th class="col-sm-4 control-label">Penjelasan</th>
                    <td width="10">:&ensp;</td>
                    <td>
                    <textarea class="form-control" rows="3" id="edit_penjelasan" name="edit_penjelasan" required></textarea>
                    </td>
                  </tr>
                </table>
              </div>              
              </div>
               <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update" /> 
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>



@endsection

@section('add-script')
<!-- DataTables -->
<script src="{{url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- FastClick -->
<script src="{{url('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>

<script>
  $(document).ready(function (){
    $('#example1').DataTable({
      'ordering'    :false
    });  
});
</script>


{{-- dependent dropdown --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script>
             $(document).ready(function() {
            $('#list_kategori_kegiatan').on('change', function() {
                var getKategoriId = $(this).val();
                if(getKategoriId) {
                    $.ajax({
                        url: '/getUraian/'+getKategoriId,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data) {
                            // console.log(data);
                          if(data){
                            $('#list_uraian_kegiatan').empty();
                            $('#list_uraian_kegiatan').focus;
                            $('#list_uraian_kegiatan').append('<option value=""></option>'); 
                            $.each(data, function(key, value){
                            $('select[name="list_uraian_kegiatan"]').append('<option value="'+ value.id +'">' + value.uraian_kegiatan+ '</option>');
                        });
                      }else{
                        $('#list_uraian_kegiatan').empty();
                      }
                      }
                    });
                }else{
                  $('#list_uraian_kegiatan').empty();
                }
            });
        });
        </script>

<!-- form -->
<script src="{{url('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>        

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    {
      placeholder: "Pilih Kategori",
      allowClear: true
    })
    $('.selecturaian').select2(
    {
      placeholder: "Pilih Uraian",
      allowClear: true
    })

  })
</script>
<script type="text/javascript">
  $("#form-kategori").hide();
  $("#form-uraian").hide();
  $("#form-sub1").hide();
  $("#form-penjelasan").hide(); 
  $(document).ready(function(){
    $("#submitpilih").click(function(){
      var pilihan = $( "#pilihopsi" ).val();
      if (pilihan == 0) {
        $("#form-kategori").hide();
        $("#form-uraian").hide();
        $("#form-sub1").hide();
        $("#form-penjelasan").hide(); 
      }
      else if (pilihan == 1) {
        $("#form-kategori").show();
        $("#form-uraian").hide();
        $("#form-sub1").hide();
        $("#form-penjelasan").hide(); 
      }
      else if (pilihan == 2){
        $("#form-uraian").show();
        $("#form-sub1").hide(); 
        $("#form-kategori").hide();
        $("#form-penjelasan").hide(); 
      }
      else if (pilihan == 3){
        $("#form-sub1").show(); 
        $("#form-uraian").hide();
        $("#form-kategori").hide();
        $("#form-penjelasan").hide(); 
      }
      else if (pilihan == 4){
        $("#form-penjelasan").show(); 
        $("#form-uraian").hide();
        $("#form-kategori").hide();
        $("#form-sub1").hide();
      }
    })
  })
</script>
<script type="text/javascript">
  submitUpdate1 = function(id, kode_tabel){
    // console.log(id);
    // console.log("hehe");
    // console.log(kode_tabel);
      $.ajax({
        url: '/getdata',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id,
          'kode_tabel' : kode_tabel
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#id').val(data.id);
          $('#kategori').val(data.kategori_kegiatan);
          $('#edit_id').val(data.id);
          $('#kategori_kegiatan1').val(data.kategori_kegiatan);
        }
      });
    }
    submitUpdate2 = function(id, kode_tabel){
      $.ajax({
        url: '/getdata',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id,
          'kode_tabel' : kode_tabel
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#id2').val(data.id);
          $('#kategori2').val(data.kategori_id);
          $('#uraian').val(data.uraian_kegiatan);
          $('#satuan').val(data.satuan);
          $('#var1').val(data.var1);
          $('#edit_id2').val(data.id);
          $('#edit_kategori2').val(data.kategori_id);
          $('#uraian_kegiatan2').val(data.uraian_kegiatan);
          $('#satuan2').val(data.satuan);
          $('#edit_var1').val(data.var1);
        }
      });
    }
    submitUpdate3 = function(id, kode_tabel){
      $.ajax({
        url: '/getdata',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id,
          'kode_tabel' : kode_tabel
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#id3').val(data.id);
          $('#uraian_id').val(data.uraian_id);
          $('#sub1_uraian3').val(data.uraian_kegiatan);
          $('#sub1_satuan3').val(data.satuan);
          $('#sub1_var1').val(data.var1);
          $('#edit_id3').val(data.id);
          $('#uraian3').val(data.uraian_id);
          $('#uraian_kegiatan3').val(data.uraian_kegiatan);
          $('#satuan3').val(data.satuan);
          $('#sub1_edit_var1').val(data.var1);
        }
      });
    }
    submitUpdate4 = function(id, kode_tabel){
      $.ajax({
        url: '/getdata',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id,
          'kode_tabel' : kode_tabel
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#id4').val(data.id);
          $('#kategori4').val(data.kategori_id);
          $('#penjelasan4').val(data.penjelasan);
          $('#edit_id4').val(data.id);
          $('#edit_kategori4').val(data.kategori_id);
          $('#edit_penjelasan').val(data.penjelasan);
        }
      });
    }
</script>
@endsection