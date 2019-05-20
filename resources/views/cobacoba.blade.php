<div class="box-body" id="1">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="80">Diklat (Rp)</th>
                <th width="20"></th>
              </tr>
        </thead>
        <tbody>
          @foreach($kegiatans as $kegiatan)
          @foreach ($kegiatan->uraian as $key => $uraian)
              @if($uraian->kategori_id == 4)
                      <tr>
                        <td>
                            {{$key+1}}. 
                        </td>
                        <td>{{ $uraian->uraian_kegiatan}}</td>
                        <td>{{ $uraian->satuan}}</td>
                        <td>{{ number_format($uraian->var1)}}</td>
                        <td>{{ number_format($uraian->var2)}}</td>
                        <td>{{ number_format($uraian->var3)}}</td>
                        <td> 
                          <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i> 
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                        </td>
                        </tr>
                @endif
          @endforeach
          @endforeach
        </tbody>
        <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="80">Diklat (Rp)</th>
                <th width="20"></th>
              </tr>
        </tfoot>
        </table>
      </div>

   <div class="box-body" id="2">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="200">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
              </thead>
             <tbody>
              @foreach($kegiatans as $kegiatan)
              @foreach ($kegiatan->uraian as $key => $uraian)
                  @if($uraian->kategori_id == 5)
                          <tr>
                            <td>
                                {{$key+1}}. 
                            </td>
                            <td>{{ $uraian->uraian_kegiatan}}</td>
                            <td>{{ $uraian->satuan}}</td>
                            <td>{{ number_format($uraian->var1)}}</td>
                            <td>{{ number_format($uraian->var2)}}</td>
                            <td> 
                              <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i>
                              <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                            </td>
                            </tr>
                    @endif
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="200">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
            </tfoot>
        </table>
      </div>
 <div class="box-body" id="3">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th rowspan="2" width="10">No.</th>
                <th rowspan="2" width="275">Negara</th>
                <th rowspan="2" width="80">Satuan</th>
                <th style="text-align: center" colspan="4">Golongan</th>
                <th rowspan="2" width="40"></th>
              </tr>
               <tr>
                  <th width="80">A</th>
                  <th width="80">B</th>
                  <th width="80">C</th>
                  <th width="80">D</th>
           </tr> 
        </thead>
        <tbody>
          {{-- @foreach($kegiatans as $kegiatan)
          @foreach ($kegiatan->uraian as $key => $uraian) --}}
          @foreach ($uraians6 as $key => $uraian)
              {{-- @if($uraian->kategori_id == 6) --}}
                  <tr>
                      <td>
                          {{$key+1}}. 
                      </td>
                      <th>{{ $uraian->uraian_kegiatan}}</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td> 
                        <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i> 
                        <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                      </td>
                    </tr>
                @foreach($uraian->sub1 as $sub1)
                <tr>
                   <td>
                      {{-- {{$key+1}}.  --}}
                  </td>
                  <td>{{ $sub1->uraian_kegiatan}}</td>
                  <td>{{ $sub1->satuan}}</td>
                  <td>{{ number_format($sub1->var1)}}</td>
                  <td>{{ number_format($sub1->var2)}}</td>
                  <td>{{ number_format($sub1->var3)}}</td>
                  <td>{{ number_format($sub1->var4)}}</td>
                  <td> 
                    <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i>
                    <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                  </td>

                </tr>
              {{-- @endif --}}
          {{-- @endforeach --}}
          @endforeach
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th width="10">No.</th>
            <th width="275">Negara</th>
            <th width="80">Satuan</th>
            <th width="80">A</th>
            <th width="80">B</th>
            <th width="80">C</th>
            <th width="80">D</th>
            <th rowspan="2" width="40"></th>
          </tr>
        </tfoot>
        </table>
      </div>

   <div class="box-body" id="4">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="275">Uraian Kegiatan</th>
                <th width="80">Satuan</th>
                <th width="80">Besaran Bruto Maksimum (Rp)</th>
                <th width="20"></th>
              </tr>
              </thead>
             <tbody>
              {{-- @foreach($kegiatans as $kegiatan)
              @foreach ($kegiatan->uraian as $key => $uraian) --}}
              @foreach ($uraians7 as $uraian)
                    <tr>
                      <td>
                          {{$key+1}}. 
                      </td>
                      <th>{{ $uraian->uraian_kegiatan}}</th>
                      <td></td>
                      <td></td>
                      <td> 
                        <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i>
                        <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                      </td>
                      </tr>
                    @foreach($uraian->sub1 as $sub1)
                    <tr>
                      <td>
                          {{-- {{$key+1}}.  --}}
                      </td>
                      <td>{{ $sub1->uraian_kegiatan}}</td>
                      <td>{{ $sub1->satuan}}</td>
                      <td>{{ number_format($sub1->var1)}}</td>
                      <td> 
                        <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i>
                        <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                      </td>
                      </tr>
              {{-- @endforeach --}}
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">Uraian Kegiatan</th>
                <th width="80">Satuan</th>
                <th width="80">Besaran Bruto Maksimum (Rp)</th>
                <th width="20"></th>
              </tr>
            </tfoot>
        </table>
      </div>
       <div class="box-body" id="5">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="80">Diklat (Rp)</th>
                <th width="20"></th>
              </tr>
        </thead>
        <tbody>
          @foreach($kegiatans as $kegiatan)
          @foreach ($kegiatan->uraian as $key => $uraian)
              @if($uraian->kategori_id == 8)
                      <tr>
                        <td>
                            {{$key+1}}. 
                        </td>
                        <td>{{ $uraian->uraian_kegiatan}}</td>
                        <td>{{ $uraian->satuan}}</td>
                        <td>{{ number_format($uraian->var1)}}</td>
                        <td>{{ number_format($uraian->var2)}}</td>
                        <td>{{ number_format($uraian->var3)}}</td>
                        <td> 
                          <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i> 
                          <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                        </td>
                        </tr>
                @endif
          @endforeach
          @endforeach
        </tbody>
        <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="275">Provinsi</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="80">Diklat (Rp)</th>
                <th width="20"></th>
              </tr>
        </tfoot>
        </table>
      </div>

   <div class="box-body" id="6">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="400">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
              </thead>
             <tbody>
              @foreach($kegiatans as $kegiatan)
              @foreach ($kegiatan->uraian as $key => $uraian)
                  @if($uraian->kategori_id == 9)
                          <tr>
                            <td>
                                {{$key+1}}. 
                            </td>
                            <td>{{ $uraian->uraian_kegiatan}}</td>
                            <td>{{ $uraian->satuan}}</td>
                            <td>{{ number_format($uraian->var1)}}</td>
                            <td>{{ number_format($uraian->var2)}}</td>
                            <td> 
                              <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i> 
                              <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                            </td>
                            </tr>
                    @endif
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="400">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
            </tfoot>
        </table>
      </div>
      <div class="box-body" id="7">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="10">No.</th>
                <th width="400">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
              </thead>
             <tbody>
              @foreach($kegiatans as $kegiatan)
              @foreach ($kegiatan->uraian as $key => $uraian)
                  @if($uraian->kategori_id == 10)
                          <tr>
                            <td>
                                {{$key+1}}. 
                            </td>
                            <td>{{ $uraian->uraian_kegiatan}}</td>
                            <td>{{ $uraian->satuan}}</td>
                            <td>{{ number_format($uraian->var1)}}</td>
                            <td>{{ number_format($uraian->var2)}}</td>
                            <td> 
                              <i class="fa fa-eye" data-toggle="modal" onclick="viewdata('{{ $uraian->id }}')" data-target="#show-modal"> | </i> 
                              <i class="fa fa-pencil" data-toggle="modal" onclick="submitUpdate('{{ $uraian->id }}')" data-target="#edit-modal">  </i>
                            </td>
                            </tr>
                    @endif
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10">No.</th>
                <th width="400">Uraian</th>
                <th width="80">Satuan</th>
                <th width="80">Luar Kota (Rp)</th>
                <th width="120">Dalam Kota Lebih dari 8 Jam (Rp)</th>
                <th width="20"></th>
              </tr>
            </tfoot>
        </table>
      </div>