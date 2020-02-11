<!DOCTYPE html>
<html>
<head>
  <title>Kartu Diterima</title>
  <style type="text/css">
    .table-me{
      font-size: 12px;
      width: 100%;
    }

    .table-me thead{
      border-bottom: 2px solid #000; 
    }

    .header .header-text{
      text-align: center;
    }

    .header .header-text small{
      font-size: 12px;
      color: #333 ;
    }

    .table-me tbody{
      border-bottom: 2px solid #eaeaea !important;
    }
  </style>
</head>
<body>
  <div id="outtable">
    <div class="header">
      <table border="0">
        <tr>
          <td width="10">
            <div class="header-img">
              <img style="width: 100px; height: 100px; border-radius: 5px;" src="/opt/lampp/htdocs/myppdb/assets/img/logo/logo-smk.png">
            </div>
          </td>
          <td>
            <div class="header-text">
              <h2>Rekap Peserta <br> PPDB SMK Muhammadiyah Mlati <br>Tahun Ajaran <?=$tahun['tahun_mulai']?>/<?=$tahun['tahun_akhir']?></h2>
              <small>Jl. Kaliurang Jl. Timor Tim. No.KM 6,5, Purwosari, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284</small>
            </div>
          </td>
        </tr>
      </table>
    </div>
      
      <!-- <p>SMK Muhammadiyah Mlati <span style="margin-left: 270px;">No.Pendaftaran : </span></p> -->
      <hr>
      <div style="overflow-x:auto;">
      <table class="table-me" border="0" cellpadding="3">
        <thead>
          <tr>
            <th style="width: 3%">No</th>
            <th style="width: 10%;">No.Pendaftaran</th>
            <th style="width: 15%;">Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Jalur Pendaftaran</th>
            <th>Program Studi</th>
            <th>Tahun Ajaran</th>
            <th>Asal Sekolah</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($rekap AS $r):

          if($r['jenis_kelamin'] == 'L'){
            $jenis_kelamin = 'Laki - Laki';
          }else{
            $jenis_kelamin = 'Perempuan';
          }
          
          ?>
          <tr class="tr-me">
            <td><?=$no++?></td>
            <td><?=ucwords($r['no_pendaftaran'])?></td>
            <td><?=ucwords($r['nama_lengkap'])?></td>
            <td><?=$jenis_kelamin?></td>
            <td><?=ucwords($r['nama_jalur_pendaftaran'])?></td>
            <td><?=ucwords($r['nama_program_studi'])?></td>
            <td><?=$tahun['tahun_mulai']?>/<?=$tahun['tahun_akhir']?></td>
            <td><?=ucwords($r['nama_sekolah_asal'])?></td>
          </tr>
          <?php
          endforeach;
          ?>
        </tbody>   
      </table>
    </div>
   </div>
</body>
</html>