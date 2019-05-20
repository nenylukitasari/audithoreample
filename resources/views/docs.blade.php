@extends('master')

@section('title')
    Dokumen SBI
@endsection
@section('right_title')
  <li class="active">Standar Biaya Institut</li>
@endsection
@section('content')
<br/>
<button type="button" class="btn btn-info btn-rounded waves-effect waves-light pull-right" data-toggle="modal" data-target="#addModal"><span class="btn-label"><i class="fa fa-plus"></i></span>Add</button>
<h3 class="box-title m-b-0">STANDAR BIAYA INSTITUT</h3>
@foreach ($versions as $version)
@endforeach
  <p class="text-muted m-b-30">Data version {{$version->version}}</p>
   <div class="table-responsive">
    <table id="example1" class="table table-striped">
      <thead>
        <tr>
          <th width="10">No.</th>
          <th width="600">Kegiatan</th>
          <th width="40"></th>
        </tr>
      </thead>
     <tbody>
        @foreach ($versions as $version)
        @foreach ($version->jenis_kegiatan as $key => $jenis_kegiatan)
          <tr>
            <td>
                {{$key+1}}. 
            </td>
            <th>
              {{ $jenis_kegiatan->jenis_kegiatan}}
            </th>
              <td> 
              <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate({{ $jenis_kegiatan->id }},{{$jenis_kegiatan->kode_tabel}})" data-target="#show-modal"> | </i>   
              <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate({{ $jenis_kegiatan->id }},{{$jenis_kegiatan->kode_tabel}})" data-target="#edit-modal"> | </i>
                <i class="fa fa-trash-o" data-toggle="modal" data-target="#delete2-modal"></i></td>
            </tr>
        @foreach ($jenis_kegiatan->kegiatan as $kegiatan)
          <tr>
            <td></td>  
              <td>
                <a href="{{ url('/data/'.$kegiatan->kode_tabel . '/' .$kegiatan->kode_bagian ) }}">{{ $kegiatan->nama_kegiatan}}</a>
              </td>
              <td>
                <i class="fa fa-eye" data-toggle="modal" onclick="submitUpdate2({{ $kegiatan->id }},{{$kegiatan->kode_tabel}})" data-target="#show-modal2"> | </i> 
                <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2({{ $kegiatan->id }},{{$kegiatan->kode_tabel}})" data-target="#edit-modal2"> | </i>
                <i class="fa fa-trash-o" data-toggle="modal" data-target="#delete-modal"></i>
              </td>
            </tr>
        @endforeach
      @endforeach
    @endforeach
    </tbody>
  </table>
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
          <option value="1">Jenis Kegiatan</option>
          <option value="2">Kegiatan</option>
        </select>
        <input type="button" name="submitpilih" id="submitpilih" class="btn btn-primary" value="Add"/>
        <div class="form-group" id="form-kegiatan">
        <br/>
        <form action="{{url('/dokumen', $kegiatan->kode_tabel)}}" method="POST"> 
          {{csrf_field()}} 
            <div class="form-group">
              <select class="form-control select2" style="width:500px" name="jenis_kegiatan" required>
                <option></option>
                @foreach($versions as $version)
                @foreach($version->jenis_kegiatan as $jk)
                <option value="{{$jk->id}}">{{$jk->jenis_kegiatan}}</option>
                @endforeach
                @endforeach
              </select>  
            </div>
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" required />
                  </div>
                </div>
              </div>
              <br/><br/><br/>
              <div class="modal-footer">  
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Add" /> 
              </div>
            </form>
          </form>
        </div>

        <div class="form-group" id="form-jenis-kegiatan">
          <form action="{{url('/dokumen', $jenis_kegiatan->kode_tabel)}}" method="POST"> 
          {{csrf_field()}} 
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Version</label>
                <div class="col-sm-10">
                  <input style="border: none; box-shadow: none;" class="form-control" type="text" size="50" id="version" name="version" value="{{$version->id}}" required/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kegiatan</label>
                <div class="col-sm-10">
                  <input type="text" name="jenis_kegiatan" placeholder="Jenis Kegiatan" class="form-control" required />
                </div>
              </div>
            <br/><br/>
            </div>
            <br/><br/></br>
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

@endsection

@section('add-script')
<!-- page script -->
<script>
  $(document).ready(function() {
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
<script type="text/javascript">
  $("#form-kegiatan").hide();
  $("#form-jenis-kegiatan").hide();
  $(document).ready(function(){
    $("#submitpilih").click(function(){
      var pilihan = $( "#pilihopsi" ).val();
      if (pilihan == 0) {
        $("#form-jenis-kegiatan").hide();
        $("#form-kegiatan").hide();
      }
      else if (pilihan == 1) {
        $("#form-jenis-kegiatan").show();
        $("#form-kegiatan").hide();
      }
      else if (pilihan == 2){
        $("#form-kegiatan").show();
        $("#form-jenis-kegiatan").hide(); 
      }

    })
  })

</script>
@endsection




