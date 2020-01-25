<!DOCTYPE html>
<html>
<head>
  <title>Report Table</title>
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
  </style>
</head>
<body>
  <div id="outtable">
    <div class="header">
      <h2 style="margin-left: 200px">Kartu Tanda Diterima</h2>
      <p>SMK Muhammadiyah Mlati <span style="margin-left: 270px;">No.Pendaftaran : 20/1/0001</span></p>
      <hr>
      <div class="gambar">
        <table border="0" cellpadding="0">
         <tr>
           <td rowspan="7" width="180"><img style="width: 200px; height: 250px; border-radius: 5px;" src="/opt/lampp/htdocs/myppdb/assets/img/user/4ab0b2796e901b9aead1e0a20a6276de.jpg"></td>
           <td>Nama</td>
           <td>:</td>
           <td>Rizki Ristanto Pratama</td>
         </tr>
         <tr>
           <td>NISN</td>
           <td>:</td>
           <td>38678657</td>
         </tr>
         <tr>
           <td>Jurusan</td>
           <td>:</td>
           <td>Komputer</td>
         </tr>
         <tr>
           <td>Tgl Lahir</td>
           <td>:</td>
           <td>10 january 2010</td>
         </tr>
         <tr>
           <td>Tempat Lahir</td>
           <td>:</td>
           <td>Jakarta</td>
         </tr>
          <tr>
           <td>Alamat</td>
           <td>:</td>
           <td>Jln. magelang Km7.5</td>
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
      <small>Kartu ini sebagai tanda bahwa peserta dengan <i>no. pendaftaran 20/1/0001</i> dengan data yang sesuai tertera diatas dinyatakan telah <strong>LOLOS</strong> dalam tahap seleksi pendaftaran penerimaan peserta didik baru pada sekolah SMK Muhamadiyah Mlati. tahap selanjutnya perserta dipersilahkan melakukan daftar ulang dengan langsung datang ke sekolah SMK Muhammadiyah Mlati dengan membawa kartu ini. Terimakasih</small>
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