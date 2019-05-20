@extends('master')

@section('title-bar')
    @foreach ($versions as $version)
    @foreach ($version->kegiatan as $kegiatan)
      @if($kegiatan->kode_bagian==2)
         {{$kegiatan->nama_kegiatan}}
       @endif
    @endforeach
    @endforeach
@endsection

@section('right_title')
@foreach ($versions as $version)
    @foreach ($version->kegiatan as $kegiatan)
    @if($kegiatan->kode_bagian==2)
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
                <th width="600">Kegiatan</th>
                <th width="20"></th>
              </tr>
              </thead>
             <tbody>
              @foreach ($versions as $version)
              @foreach ($version->kegiatan as $kegiatan)
              @if($kegiatan->kode_bagian==2)
              @foreach ($kegiatan->kategori as $key => $kategori)
                  <tr>
                    <td>
                        {{$key+1}}. 
                    </td>
                    <td>
                       <a href="{{ url('/data/'.$kategori->kode_tabel . '/' .$kategori->kode_bagian ) }}">{{ $kategori->kategori_kegiatan}}</a>
                    </td>
                      <td> 
                      <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate1({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#show-modal"> | </i> 
                      <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate1({{ $kategori->id }},{{$kategori->kode_tabel}})" data-target="#edit-modal">  </i>
                    </tr>
                @endforeach
                @endif
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="600">Kegiatan</th>
                <th width="20"></th>
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
                <form action="{{url('/data/add', $kategori->kode_tabel)}}" method="POST"> 
                  {{csrf_field()}} 
                <div class="form-group">
                  <select class="form-control select2" style="width:500px" name="kegiatan_id" required>
                      <option></option>
                    @foreach ($versions as $version)
                    @foreach ($version->kegiatan as $kegiatan)
                    @if($kegiatan->kode_bagian==2)
                     <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</option>
                      {{-- <input type="text" style="border: none; box-shadow: none;" name="kegiatan_id" value="{{$kegiatan->id}}" class="form-control" required /> --}}
                    @endif
                    @endforeach
                    @endforeach
                  </select>
                </div>
              <form class="form-horizontal">
                <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kategori</label>
                  <div class="col-sm-10">
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
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    {
      placeholder: "Pilih Kegiatan",
      allowClear: true
    })
  })
</script>
@endsection




