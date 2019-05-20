@extends('master')

@section('title-bar')
    Temuan
@endsection

@section('right_title')
    <li class="active">Temuan</li>
@endsection

@section('add-css')

 @endsection
@section('content')
<br/>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Temuan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-12">
              <label for="inputEmail3" class="col-sm-3 control-label">Filter</label>  
            </div>
              <div class="row">
                <div class="col-sm-4">
                  <select id="col1_filter" class="column_filter form-control select2" data-column="1" style="width: 100%;">
                    <option value="">Unit</option>
                    @foreach($unit as $data => $value)
                     <option value="{{$value->nama}}">{{$value->nama}}</option>
                     @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <select id="col2_filter" class="column_filter form-control" data-column="2">
                    <option value="">Bulan</option>
                    <option>Januari</option><option>Februari</option><option>Maret</option>
                    <option>April</option><option>Mei</option><option>Juni</option>
                    <option>Juli</option><option>Agustus</option><option>September</option>
                    <option>Oktober</option><option>November</option><option>Desember</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select id="col3_filter" class="column_filter form-control" data-column="3">
                    <option value="">Tahun</option>
                    <option>2018</option><option>2019</option><option>2020</option>
                    <option>2021</option><option>2022</option><option>2023</option>
                    <option>2024</option><option>2025</option><option>2026</option>
                    </select>
                </div>
              </div>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Unit</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Jenis Kda</th>
                      <th>Temuan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;?>
                    @foreach($kda as $key => $kda)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{ $kda->nama}}</td>
                      <td>{{ $kda->bulan}}</td>
                      <td>{{ $kda->tahun}}</td>
                      <td>KDA dengan temuan</td>
                      <td><button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-temuan" onclick="temuanupdate('{{ $kda->id_kda }}')">lihat</button></td>
                      <td><a href="{{ url('pdf/'.$kda->id_kda) }}"><button class="btn btn-xs btn-primary">Download</button></a> </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Unit</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Jenis Kda</th>
                      <th>Temuan</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                    </table>    
          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-temuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="temuanclose()">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Temuan</h4>
          <div id="test"></div>
      </div>
        <div class="modal-body">
          <form action="{{url('/temuan/update')}}" method="get" id="tambah_kda" enctype="multipart/form-data">
            <div>
             <table class="table table-bordered table-striped" style='width:100%'>
                <thead>
                  <tr>
                    <th width=30%>No. Kwitansi</th>
                    <th width=15%>Nominal</th>
                    <th width=50%>Uraian Temuan</th>
                    <th width=5%>Konfirmasi</th>
                  </tr>
                  <tbody id="temuan">
                  </tbody>
                </thead>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="temuanclose()" >Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
  <!-- modal temuan end -->
  
@endsection

@section('add-script')
<script>
  $(function () {
    //Initialize Select2 Elements
    $('#col1_filter').select2(
    {
      placeholder: "Unit",
      allowClear: true
    })
  })
</script>
<script>
  function filterColumn ( i ) {
      $('#example1').DataTable().column( i ).search(
          $('#col'+i+'_filter').val()
      ).draw();
  }
  $(document).ready(function (){
    //var table = $('#example1').DataTable();
    // $('#example1').DataTable();
    $('#example1').dataTable( {
      "columns": [
        { "width": "3%" },
        null,
        { "width": "10%" },
        { "width": "10%" },
        { "width": "20%" },
        { "width": "10%" },
        { "width": "10%" }
      ]
    } );

    $('select.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).attr('data-column') );
    } );

     $('#col1_filter').on( 'change', function () {
        filterColumn( $(this).attr('data-column') );
    } );
  
});
</script>
<script>
  // $(function () {
  //   $('input').iCheck({
  //     checkboxClass: 'icheckbox_square-blue',
  //     radioClass: 'iradio_square-blue',
  //     increaseArea: '20%'
  //   });
  // });
  $(function () {
    $('#datetimepicker1').datepicker({
      format: 'yyyy-mm-dd',
      startView: 2
    });
  });
  $(function () {
    $('#datetimepicker').datepicker({
      format: 'yyyy-mm-dd',
      startView: 2
    });
  });
</script>
<script>
  $(document).ready(function(){

    submitUpdate = function(id){
      $.ajax({
        url: '/kda/data',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#idkda').val(data.id_kda);
          $('#unit').val(data.unit);
          $('#jenis').val(data.jenis);
          $('#datetimepicker').val(data.bulan_audit);
        }
      });
    }

    keteranganupdate = function(id){
      $.ajax({
        url: '/kda/keterangan',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#id').val(data.id);
          $('#kondisi').val(data.kondisi);
          $('#kesimpulan').val(data.kesimpulan);
          $('#saran').val(data.saran);
          $('#rekomendasi').val(data.rekomendasi);
          $('#tanggapan').val(data.tanggapan);

        }
      });
    }
    
    temuanupdate = function(id){
      $.ajax({
        url: '/kda/temuan',
        type: 'POST',
        data: {
          '_token': "{{ csrf_token() }}",
          'id' : id
        },
        error: function() {
          console.log('Error');
        },
        dataType: 'json',
        success: function(data1) {

          console.log(data1);
          var jumlah = data1.length;
          console.log(jumlah);
          var temuansemua = '';

          //var data1 = $.parseJSON(data1);
          for (var i = 0; i < jumlah; i++)
          {
            console.log (data1[i]['kwitansi']);
            console.log (data1[i]['keterangan']);
            var kwitansi = data1[i]['kwitansi'];
            var nominal = data1[i]['nominal'];
            var keterangan = data1[i]['keterangan'];
            var status = data1[i]['status'];
            var id = data1[i]['id'];
            console.log("ini status");
            console.log (status);
            if (status == 1) {
              temuansemua = 
            `<tr><td name="kwitansi[${i}]">${kwitansi}</td><td name="nominal[${i}]">${nominal}</td><td name="keterangan[${i}]">${keterangan}</td><td>Telah dikonfirmasi</td></tr>`;
             $("#temuan").append(temuansemua);
            }
            else
            {
              temuansemua= 
              `<tr><td name="kwitansi[${i}]">${kwitansi}</td><td name="nominal[${i}]">${nominal}</td><td name="keterangan[${i}]">${keterangan}</td><td><input type="checkbox" name="checkbox[]" data-id="${id}" value="${id}" id="checkbox[]"></td></tr>`;
              $("#temuan").append(temuansemua);
            }
          }
        }
      });
    }

    temuanclose = function(){
      $("#temuan").empty();
    }

  });     
</script>


@endsection