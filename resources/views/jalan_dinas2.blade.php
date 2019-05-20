@extends('master')

@section('title-bar')
    Satuan Biaya Perjalanan Dinas
@endsection

@section('right_title')
    Satuan Biaya Perjalanan Dinas
@endsection

@section('add-css')
<!-- DataTables -->
   <link rel="stylesheet" href="{{url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
   <!-- Form -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
{{--   <style type="text/css">
    th {
  /*text-align: center;*/
  vertical-align: middle;
  }

  </style> --}}
 @endsection
@section('content')
<br/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                  @foreach ($kategoris as $kegiatan)
                    {{$kegiatan->nama_kegiatan}}
                  @endforeach
                </h3>
              <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add
          </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               @foreach ($kategoris as $kategoria)
               @foreach ($kategoria->kategori as $kategori)
                <h4 class="box-title">{{$kategori->kategori_kegiatan}} &nbsp;<i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2('{{ $kategori->id }}')" data-target="#edit-modal1"> </i></h4>
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  @foreach($kategori->uraian as $uraian)
                  @endforeach
                  @if(strpos($kategori->kategori_kegiatan, 'Dalam Negeri') !== false)
                      <th width="10">No.</th>
                      <th width="400">Provinsi</th>
                  @elseif(strpos($kategori->kategori_kegiatan, 'Representasi') !== false)
                      <th width="10">No.</th>
                      <th width="400">Uraian</th>
                  @elseif(strpos($kategori->kategori_kegiatan, 'Luar Negeri') !== false)
                      <th rowspan="2" width="10">No.</th>
                      <th rowspan="2" width="400">Negara</th>
                      <th rowspan="2" width="80">Satuan</th>
                      <th style="text-align: center" colspan="4">Golongan</th>
                      <th rowspan="2" width="40"></th>
                  @elseif(strpos($kategori->kategori_kegiatan, 'Mahasiswa') !== false)
                      <th width="10">No.</th>
                      <th width="400">Jenis Perjalanan</th>
                  @else
                      <th width="10">No.</th>
                      <th width="400">Uraian Kegiatan</th>
                  @endif
                  @if(strpos($kategori->kategori_kegiatan, 'Luar Negeri') === false)
                      <th width="80">Satuan</th>
                  @endif
                  @if(strpos($kategori->kategori_kegiatan, 'Luar Negeri') === false || strpos($kategori->kategori_kegiatan, 'Taksi') !== false)
                      <th width="80">Besaran Bruto Maksimum (Rp)</th>
                  @elseif(strpos($kategori->kategori_kegiatan, 'Luar Negeri')!==false)
                  @else
                      <th width="80">Luar Kota (Rp)</th>
                  @endif
                  @if ($uraian->var2 != null && strpos($kategori->kategori_kegiatan, 'Luar Negeri') === false)
                      <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                  @elseif(strpos($kategori->kategori_kegiatan, 'Mahasiswa'))
                      <th width="40">Biaya Penginapan</th>
                      <th width="40">Biaya Transport</th>
                  @endif
                  @if ($uraian->var3 != null && strpos($kategori->kategori_kegiatan, 'Luar Negeri') === false)
                      <th width="80">Diklat (Rp)</th>
                  @endif
                  @if(strpos($kategori->kategori_kegiatan, 'Luar Negeri') === false)
                      <th width="40"></th>
                  @endif
                </tr>
                @if(strpos($kategori->kategori_kegiatan, 'Luar Negeri') !== false)
                    <tr>
                      <th width="80">A</th>
                      <th width="80">B</th>
                      <th width="80">C</th>
                      <th width="80">D</th>
                    </tr>                  
                @endif
                </thead>

                {{-- @if(strpos($kategori->kategori_kegiatan, 'Dalam Negeri') === false) --}}
               <tbody>
                @foreach ($kategori->uraian as $uraian)
                    <tr>
                      <td></td>
                      @if($uraian->satuan == null)
                      <th>
                          {{ $uraian->uraian_kegiatan}}
                      </th>
                      <td></td>
                      <td></td>
                      @foreach($uraian->sub1 as $sub1)
                      @endforeach 
                          @if($sub1->var2 != null)
                            <td></td>
                          @endif
                          @if($sub1->var3 != null)
                            <td></td>
                          @endif
                          @if($sub1->var4 != null)
                            <td></td>
                          @endif
                      {{-- @elseif ($uraian->satuan != null && strpos($kategori->kategori_kegiatan, 'Dalam Negeri') === false) --}}
                      @else
                        <td>{{ $uraian->uraian_kegiatan}}</td>
                        <td>{{ $uraian->satuan}}</td>
                      @endif
                      {{-- @if(strpos($kategori->kategori_kegiatan, 'Dalam Negeri') === false) --}}
                          @if($uraian->var1 != null)
                            <td>
                            {{number_format($uraian->var1)}}</td>
                          @endif 
                          @if($uraian->var2 != null)
                            <td>
                            {{number_format($uraian->var2)}}</td>
                          @elseif(strpos($kategori->kategori_kegiatan, 'Mahasiswa') !== false && $uraian->var2 == null)
                            <td>at cost</td>
                          @endif 
                          @if($uraian->var3 != null)
                            <td>
                            {{number_format($uraian->var3)}}</td>
                          @elseif(strpos($kategori->kategori_kegiatan, 'Mahasiswa') !== false && $uraian->var3 == null)
                            <td>at cost</td>
                          @endif 
                          @if($uraian->var4 != null)
                            <td>
                            {{number_format($uraian->var4)}}</td>
                          @endif 
                      <td>
                        <i class="fa fa-eye" data-toggle="modal" onclick="viewdata2('{{ $uraian->id }}')" data-target="#show-modal2"> | </i> 
                        <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2('{{ $uraian->id }}')" data-target="#edit-modal2"> </i>
                      </td>
                      {{-- @endif --}}
                    </tr>
                      @foreach ($uraian->sub1 as $sub1)
                      <tr>
                      <td></td>
                      <td>
                          {{ $sub1->uraian_kegiatan}}
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
                      @if($sub1->var2 != null)
                        <td>
                        {{number_format($sub1->var2)}}</td>
                      @endif 
                      @if($sub1->var3 != null)
                        <td>
                        {{number_format($sub1->var3)}}</td>
                      @endif 
                      @if($sub1->var4 != null)
                        <td>
                        {{number_format($sub1->var4)}}</td>
                      @endif 
                      <td>
                        <i class="fa fa-eye" data-toggle="modal" onclick="viewdata2('{{ $sub1->id }}')" data-target="#show-modal2"> | </i> 
                        <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2('{{ $sub1->id }}')" data-target="#edit-modal2"> </i>
                      </td>
                    </tr>
                    @endforeach

                    

                </tbody>
                @endforeach
                    {{-- batas suci --}}

                {{-- @elseif ($uraian->satuan != null && strpos($kategori->kategori_kegiatan, 'Dalam Negeri') !== false)
                      @else 
                <tbody>
                            @foreach ($provinsis as $provinsi)
                            @foreach ($provinsi->uraian as $provinsi_uraian)
                            <tr>
                            <td>{{$provinsi->provinsi}}</td>
                            <td>{{$provinsi_uraian->satuan}}</td>
                              @if($provinsi_uraian->var1 != null)
                              <td>{{number_format($provinsi_uraian->var1)}}</td>
                              @endif
                              @if($provinsi_uraian->var2 != null)
                              <td>{{number_format($provinsi_uraian->var2)}}</td>
                              @endif
                              @if($provinsi_uraian->var3 != null)
                              <td>{{number_format($provinsi_uraian->var3)}}</td>
                              @endif
                              @if($provinsi_uraian->var4 != null)
                              <td>{{number_format($provinsi_uraian->var4)}}</td>
                              @endif
                              <td>
                                <i class="fa fa-eye" data-toggle="modal" onclick="viewdata2('{{ $uraian->id }}')" data-target="#show-modal2"> | </i> 
                                <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate2('{{ $uraian->id }}')" data-target="#edit-modal2"> </i>
                              </td>
                            </tr>
                          @endforeach     
                      @endforeach
                      @endif
                    </tbody> --}}

              </table>
              <br>
              @endforeach
            @endforeach
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>

  
@endsection

@section('add-script')
<!-- DataTables -->
{{-- <script src="{{url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}
<script src="{{url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- FastClick -->
<script src="{{url('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
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

  })
</script>


@endsection