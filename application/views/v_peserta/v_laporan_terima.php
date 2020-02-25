<!DOCTYPE html>
<html>
<head>
  <title>Kartu Diterima</title>
  <style type="text/css">
 
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

    .ket{
      text-align: justify;
    }

    .hormat{
      float: right;
      margin-top: 20px;
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
                <h2>Panitia Penerimaan Peserta Didik Baru <br> PPDB SMK Muhammadiyah Mlati</h2>
                <small>Jl. Timor Tim. No.KM 6,5, Purwosari, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284 <br> Telp. 0889659827592</small>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <!-- <p>Jalur Pendaftaran: <?=ucwords($peserta['nama_jalur_pendaftaran'])?> <span style="float: right;">No.Pendaftaran : <?=$peserta['no_pendaftaran']?></span></p> -->
      <hr>
      <div class="header-text">
        <h3>Surat Pemberitahuan Penerimaan Peserta Didik Baru<br>Tahun Ajaran <?=$tahun['tahun_mulai']?>/<?=$tahun['tahun_akhir']?></h3>
      </div>
      <div class="gambar">
        <table border="0" cellpadding="0">
         <tr>
           <td rowspan="8" width="180"><img style="width: 200px; height: 250px; border-radius: 5px;" src="/opt/lampp/htdocs/myppdb/assets/uploads/berkas_peserta/<?=$peserta['pas_foto']?>"></td>
           <td>No. Pendaftaran</td>
           <td>:</td>
           <td><?=ucwords($peserta['no_pendaftaran'])?></td>
         </tr>
         <tr>
           <td>Nama</td>
           <td>:</td>
           <td><?=$peserta['nama_lengkap']?></td>
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
      <p>Surat ini sebagai tanda bahwa peserta dengan <i>no. pendaftaran <?=$peserta['no_pendaftaran']?></i> dengan data yang sesuai tertera diatas dinyatakan telah <strong style="color: green">DITERIMA</strong> dalam tahap seleksi pendaftaran penerimaan peserta didik baru pada sekolah SMK Muhamadiyah Mlati. tahap selanjutnya perserta dipersilahkan melakukan daftar ulang dengan langsung datang ke sekolah SMK Muhammadiyah Mlati dengan membawa surat ini. Terimakasih</p>
    </div>
    <div class="biaya">
      <p><span style="color: red;">*</span><strong> Rincian Biaya Masuk</strong> <br><small>Berikut rincian biaya masuk yang harus dibayarkan saat melakukan pendaftaran ulang.</small></p>
      
      <table style="background-color: #fff; width: 100%">
        <thead style="background-color: maroon; color: #fff; text-align: center">
          <tr>
            <th>Biaya Masuk</th>
            <th>Batas Pembayaran</th>
            <th>Sejumlah</th>
          </tr>
        </thead>
        <tbody style="text-align: center;">
                <?php 
                $total = 0;
                foreach ($biaya as $b) :
                  $tgl = DateTime::createFromFormat('Y-m-d', $b['batas_pembayaran'])->format('d F Y');
                  $total += $b['jumlah_biaya_masuk'] ;
                 ?>
                <tr>
                  <td><?= ucwords($b['jenis_biaya_masuk'])?></td>
                  <td><?= $tgl ?></td>
                  <td>Rp. <?= number_format($b['jumlah_biaya_masuk'])?></td>
                </tr>
                <?php
              endforeach;
                ?>
                <tr style="background-color: #eaeaea">
                  <td colspan="2" class="text-center"><strong>-Total-</strong></td>
                  <td>Rp. <?= number_format($total)?></td>
                </tr>
              </tbody>
            </table>
    </div>
    <div class="ket" style="margin-top: 20px;">
      <p>Demikian surat pemberitahuan penerimaan peserta didik baru ini kami sampaikan. Atas perhatianya kami ucapkan terimakasih.</p>
    </div>

    <div class="hormat">
      <p style="margin-left: 65px;">Hormat Kami,</p>
      <p style="margin-top: 60px;">Panitia Penerimaan Peserta Didik Baru</p>
    </div>
   </div>
</body>
</html>