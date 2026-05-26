<?php
$this->load->view('dashboard/footer');
?><style>body{background-size: cover;}</style><script>$(document).ready(function(){resize();});$(window).resize(function(){resize();});function resize() {var screen_width = window.innerWidth;var path = '<?php echo base_url()."assets/images/"?>'
var background=screen_width>768?'maintain':'maintain_mobile';$('body').css('background-image','url('+path+background+'.png)');}</script>