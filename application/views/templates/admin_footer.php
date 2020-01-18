<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Powered By <a href="https://adminlte.io">Rizki Ristanto</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 SMK MUHAMMADIYAH MLATI.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 4000
    });
    <?php 
    if($this->session->flashdata('msg_failed')){
    ?>
      Toast.fire({
        type: 'error',
        title: '<?= $this->session->flashdata('msg_failed')?>'
      });
    <?php 
    }elseif($this->session->flashdata('msg_success')){
    ?>
    Toast.fire({
        type: 'success',
        title: '<?= $this->session->flashdata('msg_success')?>'
    });
    <?php
    }
    ?>
});
</script>

<script type="text/javascript">    
    //fungsi untuk menampilkan jam saat ini    
        function tampilkanwaktu(){   
            var waktu = new Date();
            var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
            var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
            var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
        }
    </script>

</body>
</html>