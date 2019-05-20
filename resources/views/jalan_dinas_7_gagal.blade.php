@extends('master')

@section('title-bar')
  @foreach ($versions as $version)
  @foreach ($version->kegiatan as $kegiatan)
    @if($kegiatan->kode_bagian==2)
    @foreach($kegiatan->kategori as $kategori)
    @if($kategori->kode_bagian==8)
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
@if($kegiatan->kode_bagian==2)
  <li class="active"><a href="/data/2/2">{{$kegiatan->nama_kegiatan}}</a></li>
  @foreach($kegiatan->kategori as $kategori)
    @if($kategori->kode_bagian==8)
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
                    @if($kegiatan->kode_bagian==2)
                      @foreach($kegiatan->kategori as $kategori)
                        @if($kategori->kode_bagian==8)
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
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Besaran (Rp)</th>
                <th width="30"></th>
              </tr>
              </thead>
             <tbody>
              @foreach($provinsis as $key => $provinsi)
                <tr>
                  <td>
                      {{$key+1}}. 
                  </td>
                  <td>
                    {{ $provinsi.provinsi}}
                  </td>
                  <td>{{$provinsi->satuan}}</td>
                  <td>{{number_format($provinsi->var1)}}</td>
                    <td> 
                    <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate({{ $provinsi->id }},{{$provinsi->kode_tabel}})" data-target="#show-modal"> | </i> 
                <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate({{ $provinsi->id }},{{$provinsi->kode_tabel}}) "data-target="#edit-modal"> </i>
                  </tr>
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Besaran (Rp)</th>
                <th width="30"></th>
              </tr>
            </tfoot>
        </table>
        <br/>
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




