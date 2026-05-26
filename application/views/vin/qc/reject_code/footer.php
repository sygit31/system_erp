<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">

	$(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()

	    //Datemask dd/mm/yyyy
	    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	  
	    //Money Euro
	    $('[data-mask]').inputmask()

	    //Datatable
	    $("#example1").DataTable();
	});


	function kosong_isian()
	{
		// var isi = document.getElementById('cmbRejectCode').value
		// document.getElementById('cmbRejectCode').value = "2"
		// var select = document.getElementById("cmbRejectCode");
		// select.options[select.selectedIndex].text = "";
		// select.options[select.selectedIndex].value = 0;
		// window.alert(select.options[select.selectedIndex].text);
		// if(select.options.length > 0) {
  //   		window.alert(select.options[select.selectedIndex].text);
		// } else {
  //   		window.alert("Select box is empty");
		// }
	}


	/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
  alert(document.getElementById("cmbRejectCode").text);
}

function myselect() {
	// alert(document.getElementById("cmbRejectCode").length);
	document.getElementById("myDropdown").classList.toggle("show");
  // alert ([pilih].selectedIndex);
  // alert (pilih);
  // document.getElementById("cmbRejectCode").value = pilih;
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("option");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function validasi(){
	var TestCode = document.getElementById('cmbTestCode');
	if (TestCode.value == ""){
		alert("Test Code belum diisi!");
		TestCode.focus();
		return (false);
	}
	var RejectCode = document.getElementById('txtRejectCode');
	if (RejectCode.value == ""){
		alert("Reject Code belum diisi!");
		RejectCode.focus();
		return (false);
	}
	var RejectDescription = document.getElementById('txtRejectDescription');
	if (RejectDescription.value == ""){
		alert("Reject Description belum diisi!");
		RejectDescription.focus();
		return (false);
	}
}

</script>

<style type="text/css">
	/* The search field */
	#myInput {
	  font-size: 16px;
	  padding: 14px 20px 12px 16px;
	  border: none;
	  border-bottom: 1px solid #ddd;
	  width: 500px;
	}

	/* The search field when it gets focus/clicked on */
	#myInput:focus {
		outline: 3px solid #ddd;
	}

	/* Dropdown Content (Hidden by Default) */
	.dropdown-content {
	  display: none;
	  position: absolute;
	  background-color: #f6f6f6;
	  min-width: 500px;
	  border: 1px solid #ddd;
	  z-index: 1;
	}

	/* Links inside the dropdown */
	.dropdown-content option {
	  color: black;
	  padding: 12px 16px;
	  text-decoration: none;
	  display: block;
	}

	/* Change color of dropdown links on hover */
	.dropdown-content option:hover {
		background-color: #99ccff;
		cursor: pointer;
	}

	/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
	.show {
		display:block;
	}

	.pilih {
		display: none;
	}
</style>