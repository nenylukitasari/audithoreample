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
            <br/> 
           <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th width="10">No.</th>
                <th width="275">Uraian</th>
                <th width="80">Satuan</th>
                <th width="100">Besaran Bruto Maksimum (Rp)</th>
                <th width="40"></th>
              </tr>
              </thead>
             <tbody>
              @foreach ($versions as $version)
              @foreach ($version->kegiatan as $kegiatan)
              @if($kegiatan->kode_bagian==$kode_bagian_kegiatan)
              @foreach ($kegiatan->kategori as $key => $kategori)
              <tr>
                <td>{{$key+1}}</td>  
                  <td>
                    {{ $kategori->kategori_kegiatan}}</a>
                  </td>
                  <td>
                    {{ $kategori->satuan}}</a>
                  </td>
                  <td>
                    {{ number_format($kategori->var1)}}</a>
                  </td>
                  <td>
                    <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#show-modal"> | </i> 
                    <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#edit-modal"> | </i>
                  </td>
                </tr>
                @endforeach
                @endif
              @endforeach
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">Uraian</th>
                <th width="80">Satuan</th>
                <th width="100">Besaran Bruto Maksimum (Rp)</th>
                <th width="40"></th>
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
                <label class="col-sm-3 control-label">Uraian</label>
                <div class="col-sm-9">
                  <textarea class="form-control" rows="3" id="kategori_kegiatan" name="kategori_kegiatan" placeholder="Uraian Kegiatan" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Satuan</label>
                <div class="col-sm-9">
                  <input type="text" name="satuan_kategori" placeholder="Satuan" class="form-control" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Bruto</label>
                <div class="col-sm-9">
                  <input type="number" name="var1_kategori" placeholder="Besaran Bruto Maksimum (Rp)" class="form-control" required />
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
                <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="id" name="id" disabled> </td>
              </tr>
              <tr>
                <th class="col-sm-3 control-label">Kegiatan</th>
                <td width="10">:</td>
                <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="kegiatan_id2" name="kegiatan_id2" disabled></td>
              </tr>
             <tr>
                <th style="vertical-align: top; padding-top: 5px;" class="col-sm-3 control-label">Uraian Kegiatan</th>
                <td style="vertical-align: top; padding-top: 5px;" width="10">:</td>
                <td><textarea style="border: none; box-shadow: none;" class="form-control" rows="3" id="kategori_kegiatan" name="kategori_kegiatan" disabled></textarea> </td>
              </tr>
              <tr>
                <th class="col-sm-3 control-label">Satuan</th>
                <td width="10">:</td>
                <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="kategori_satuan" name="kategori_satuan" disabled></td>
              </tr>
              <tr>
                <th class="col-sm-3 control-label">Besaran Bruto Maksimum (Rp)</th>
                <td width="10">:</td>
                <td><input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="kategori_var1" name="kategori_var1" disabled></td>
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
            <form action="{{url('/data/update', $kategori->kode_tabel)}}" method="POST">
            {{csrf_field()}} 
            <div class="box-body">
              <table border="0">
                <tr>
                  <th class="col-sm-3 control-label">ID</th>
                  <td width="10">:</td>
                  <td><input type="text" style="border: none; box-shadow: none;" class="form-control" id="edit_id" name="edit_id" required></td>
                </tr>
                <tr>
                  <th class="col-sm-4 control-label">Uraian Kegiatan</th>
                  <td width="10">:&ensp;</td>
                  <td>
                  <textarea class="form-control" rows="3" id="kategori_kegiatan1" name="kategori_kegiatan1" required></textarea>
                  </td>
                </tr>
                <tr>
                  <th class="col-sm-3 control-label">Satuan</th>
                  <td width="10">:</td>
                  <td>
                  <input type="text" class="form-control" id="edit_kategori_satuan" name="edit_kategori_satuan" placeholder="Satuan" required>
                  </td>
                </tr>
                <tr>
                  <th class="col-sm-3 control-label">Besaran Bruto Maksimum (Rp)</th>
                  <td width="10">:</td>
                  <td>
                  <input type="number" class="form-control" id="edit_kategori_var1" name="edit_kategori_var1" placeholder="Besaran Bruto Maksimum (Rp)" required>
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

<!-- page script -->
<script>
  $(document).ready(function (){
    //var table = $('#example1').DataTable();
    $('#example1').DataTable({
      'ordering'    :false
    });

    $('.select2').select2(
    {
      placeholder: "Pilih Jenis Kegiatan",
      allowClear: true
    });

    $('.year').select2(
    {
      placeholder: "",
      allowClear: true
    });
  
});
</script>

<!-- form -->
<script src="{{url('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>        

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
          $('#id').val(data.id);
          $('#kegiatan_id2').val(data.kegiatan_id);
          $('#kategori_kegiatan').val(data.kategori_kegiatan);
          $('#kategori_satuan').val(data.satuan);
          $('#kategori_var1').val(data.var1);
          $('#edit_id').val(data.id);
          $('#edit_kategori_kegiatan').val(data.kategori_kegiatan);
          $('#edit_kategori_satuan').val(data.satuan);
          $('#edit_kategori_var1').val(data.var1);
        }
      });
    }
</script>
@endsection




