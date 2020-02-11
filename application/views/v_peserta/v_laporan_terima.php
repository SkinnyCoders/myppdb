<!DOCTYPE html>
<html>
<head>
  <title>Kartu Diterima</title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      width:650px;
      border-radius: 5px;
      background-color: #dbf9c0;
    }
 
    .gambar{
      margin-top: 10px;
      display: inline-block;
    }

    .header .header-text{
      text-align: center;
    }

    .header .header-text small{
      font-size: 12px;
      color: #333 ;
    }
  </style>
</head>
<body>
  <div id="outtable">
    <div class="header">
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
                <h2>Kartu Tanda Diterima <br> PPDB SMK Muhammadiyah Mlati <br>Tahun Ajaran <?=$tahun['tahun_mulai']?>/<?=$tahun['tahun_akhir']?></h2>
                <small>Jl. Kaliurang Jl. Timor Tim. No.KM 6,5, Purwosari, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284</small>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <p>Jalur Pendaftaran: <?=ucwords($peserta['nama_jalur_pendaftaran'])?> <span style="float: right;">No.Pendaftaran : <?=$peserta['no_pendaftaran']?></span></p>
      <hr>
      <div class="gambar">
        <table border="0" cellpadding="0">
         <tr>
           <td rowspan="7" width="180"><img style="width: 200px; height: 250px; border-radius: 5px;" src="/opt/lampp/htdocs/myppdb/assets/uploads/berkas_peserta/<?=$peserta['pas_foto']?>"></td>
           <td>Nama</td>
           <td>:</td>
           <td><?=ucwords($peserta['nama_lengkap'])?></td>
         </tr>
         <tr>
           <td>NISN</td>
           <td>:</td>
           <td><?=$peserta['nisn']?></td>
         </tr>
         <tr>
           <td>Jurusan</td>
           <td>:</td>
           <td><?=ucwords($peserta['nama_program_studi'])?></td>
         </tr>
         <tr>
           <td>Jenis Kelamin</td>
           <td>:</td>
           <td><?php if($peserta['jenis_kelamin'] == 'L'){
            echo 'Laki - Laki';
           }else{
            echo 'Perempuan';
           }?></td>
         </tr>
         <tr>
           <td>Tgl Lahir</td>
           <td>:</td>
           <td>
            <?php 
            echo $tgl = DateTime::createFromFormat('Y-m-d', $peserta['tgl_lahir'])->format('d F Y');
             ?>
           </td>
         </tr>
         <tr>
           <td>Tempat Lahir</td>
           <td>:</td>
           <td><?=ucwords($peserta['tempat_lahir'])?></td>
         </tr>
          <tr>
           <td>Alamat</td>
           <td>:</td>
           <td><?=$peserta['alamat_rumah']?></td>
         </tr>
          <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
        </table>
      </div>
    </div>
    <div class="ket" style="margin-top: 20px;">
      <small>Kartu ini sebagai tanda bahwa peserta dengan <i>no. pendaftaran <?=$peserta['no_pendaftaran']?></i> dengan data yang sesuai tertera diatas dinyatakan telah <strong>LOLOS</strong> dalam tahap seleksi pendaftaran penerimaan peserta didik baru pada sekolah SMK Muhamadiyah Mlati. tahap selanjutnya perserta dipersilahkan melakukan daftar ulang dengan langsung datang ke sekolah SMK Muhammadiyah Mlati dengan membawa kartu ini. Terimakasih</small>
    </div>
    <!-- <table>
      <thead>
        <tr>
          <th class="short">#</th>
          <th class="normal">First Name</th>
          <th class="normal">Last Name</th>
          <th class="normal">Username</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        <?php foreach($users as $user): ?>
          <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $user['firstname']; ?></td>
          <td><?php echo $user['lastname']; ?></td>
          <td><?php echo $user['email']; ?></td>
          </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
      </tbody>
    </table> -->
   </div>
</body>
</html>