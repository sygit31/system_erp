<script type="text/javascript">
  
  function validasi(form){
    var username = document.getElementById("txtUserBaru");
    var pass = document.getElementById("txtPass");
    var pass1 = document.getElementById("txtPassBaru1");
    var pass2 = document.getElementById("txtPassBaru2");

    if (pass.value == "") {
      alert('Password aktif belum diisi');
      pass.focus();
      return false;
    }else{
      if (pass1.value != pass2.value) {
        alert('Konfirmasi Password Salah');
        pass2.focus();
        return false;
      }else{
        if (username.value == "" && pass1.value == "" && pass2.value == "") {
          alert('Belum ada data yang diubah');
          return false;
        }else{
          return true;
          //proses di controler
        }
      }
    }
  }

</script>