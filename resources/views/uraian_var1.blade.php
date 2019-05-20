@extends('master')

@section('title-bar')
  @foreach ($versions as $version)
  @foreach ($version->kegiatan as $kegiatan)
    @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
    @foreach($kegiatan->kategori as $kategori)
    @if($kategori->kode_bagian == $kode_bagian_kategori)
       {{$kategori->kategori_kegiatan}}
    @endif
    @endforeach
    @endif
  @endforeach
  @endforeach
@endsection

@section('right_title')
@foreach ($versions as $version)
@foreach ($version->kegiatan as $kegiatan)
@if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
  <li class="active"><a href="/data/2/{{$kode_bagian_kegiatan}}">{{$kegiatan->nama_kegiatan}}</a></li>
  @foreach($kegiatan->kategori as $kategori)
    @if($kategori->kode_bagian == $kode_bagian_kategori)
    <li class="active">{{$kategori->kategori_kegiatan}}</li>
    @endif
  @endforeach
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

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
                      @foreach($kegiatan->kategori as $kategori)
                        @if($kategori->kode_bagian == $kode_bagian_kategori)
                          {{strtoupper($kategori->kategori_kegiatan)}}
                        @endif
                      @endforeach
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
                <th width="275">
                @if ($kode_bagian_kategori == 30 || $kode_bagian_kategori == 31)
                    Nama Daerah
                @else
                    Uraian Kegiatan
                @endif
                </th>
                <th width="80">Satuan</th>
                <th width="80">Besaran Bruto Maksimum (Rp)</th>
                <th width="30"></th>
              </tr>
              </thead>
             <tbody>
              @foreach ($versions as $version)
                  @foreach ($version->kegiatan as $kegiatan)
                    @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
                      @foreach($kegiatan->kategori as $kategori)
                        @if($kategori->kode_bagian == $kode_bagian_kategori)
                          @foreach($kategori->uraian as $key => $uraian)
                          <tr>
                            <td>
                                {{$key+1}}. 
                            </td>
                            <td>
                              {{ $uraian->uraian_kegiatan}}
                            </td>
                            <td>{{$uraian->satuan}}</td>
                            <td>
                            @if($uraian->var1==null || $uraian->var1==0)
                                <i>at cost</i>
                              @else
                                {{number_format($uraian->var1)}}
                            @endif
                            </td>
                              <td> 
                              <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate({{ $uraian->id }},{{$uraian->kode_tabel}})" data-target="#show-modal"> | </i> 
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate({{ $uraian->id }},{{$uraian->kode_tabel}}) "data-target="#edit-modal"> </i>
                            </tr>
                           @endforeach
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">
                @if ($kode_bagian_kategori == 30 || $kode_bagian_kategori == 31)
                    Nama Daerah
                @else
                    Uraian Kegiatan
                @endif
                </th>
                <th width="80">Satuan</th>
                <th width="80">Besaran Bruto Maksimum (Rp)</th>
                <th width="30"></th>
              </tr>
            </tfoot>
        </table>
        <br/>
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
      <div class="form-group">
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
                          @if($kategori->kode_bagian == $kode_bagian_kategori)
                           <option value="{{$kategori->id}}">{{$kategori->kategori_kegiatan}}</option>
                          @endif
                        @endforeach
                        @endif
                      @endforeach
                    @endforeach
                    </select>  
                  </div>
          <form class="form-horizontal">
            <div class="box-body">
              @if($kode_bagian_kategori==30 || $kode_bagian_kategori == 31)
              <div class="form-group">
                <label class="col-sm-3 control-label">Daerah</label>
                <div class="col-sm-9">
                  <textarea class="form-control" rows="3" id="uraian_kegiatan" name="uraian_kegiatan" placeholder="Nama Daerah" required></textarea>
                </div>
              </div>
              @else
              <div class="form-group">
                <label class="col-sm-3 control-label">Uraian</label>
                <div class="col-sm-9">
                  <textarea class="form-control" rows="3" id="uraian_kegiatan" name="uraian_kegiatan" placeholder="Uraian Kegiatan" required></textarea>
                </div>
              </div>
              @endif
              <div class="form-group">
                <label class="col-sm-3 control-label">Satuan</label>
                <div class="col-sm-9">
                  <input type="text" name="satuan" placeholder="Satuan" class="form-control" required />
                </div>
              </div>
              @if($kode_bagian_kategori==24)
              <div class="form-group">
                <label class="col-sm-3 control-label">Bruto</label>
                <div class="col-sm-9">
                  <input type="number" name="var1" placeholder="Masukkan 0 jika nominal at cost" class="form-control" required />
                </div>
              </div>
              @else
              <div class="form-group">
                <label class="col-sm-3 control-label">Bruto</label>
                <div class="col-sm-9">
                  <input type="number" name="var1" placeholder="Besaran Bruto Maksimum (Rp)" class="form-control" required />
                </div>
              </div>
              @endif
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
<div class="modal fade" id="show-modal">
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
                @if($kode_bagian_kategori==30 || $kode_bagian_kategori==31)
                <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Nama Daerah</th>
                @else
                <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Uraian Kegiatan</th>
                @endif
                <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="uraian" name="uraian" disabled></textarea> </td>
              </tr>
              <tr>
                <th class="col-sm-3 control-label">Satuan</th>
                <td width="10">:</td>
                <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="satuan" name="satuan" disabled></td>
              </tr>
              <tr>
                <th class="col-sm-3 control-label">Besaran Bruto Maksimum (Rp)</th>
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

<!-- Edit Modal -->
<div class="modal fade" id="edit-modal">
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
                  <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_kategori2" name="edit_kategori2" required></td>
                </tr>
                <tr>
                  @if($kode_bagian_kategori==30 || $kode_bagian_kategori==31)
                      <th class="col-sm-4 control-label">Nama Daerah</th>
                  @else
                      <th class="col-sm-4 control-label">Uraian Kegiatan</th>
                  @endif
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
                  <th class="col-sm-3 control-label">Besaran Bruto Maksimum (Rp)</th>
                  <td width="10">:</td>
                  <td>
                  <input type="number" class="form-control" id="edit_var1" name="edit_var1" placeholder="Besaran Bruto Maksimum (Rp)" required>
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

<!-- form -->
<script src="{{url('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>        

<script>
  $(document).ready(function (){
    $('#example1').DataTable({
      'ordering'    :false
    });  
});
</script>
<script type="text/javascript">
    submitUpdate = function(id, kode_tabel){
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
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    {
      placeholder: "Pilih Kategori",
      allowClear: true
    })
  })
</script>

@endsection




