
<aside class="main-sidebar">
    <div class="sidebar" style="height: 85vh; overflow: hidden; margin-top: 30%;">

        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <div class="pt-3 thumbnails">
                    <div id="box1" class="small-box bg-success" onclick="box(this)">
                        <div class="inner">
                            <h5>Overall Productivity</h5>
                            <p><?php echo date('d-M-y'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info</a>
                    </div>
                    <div id="box2" class="small-box bg-warning" onclick="box(this)">
                        <div class="inner text-white">
                            <h5>Data Project</h5>
                            <p><?php echo date('d-M-y'); ?></p>
                        </div>
                        <div class="icon" style="line-height: 100%;">
                            <i class="ion ion-calendar" style="font-size: 70%;"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info</a>
                    </div>
                    <div id="box3" class="small-box bg-primary" onclick="box(this)">
                        <div class="inner">
                            <h5>Other Info</h5>
                            <p><?php echo date('d-M-y'); ?></p>
                        </div>
                        <div class="icon" style="line-height: 100%;">
                            <i class="ion ion-medkit" style="font-size: 80%;"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info</a>
                    </div>
                    <div id="box4" class="small-box bg-danger" onclick="box(this)">
                        <div class="inner text-white">
                            <h5>Video</h5>
                            <p><?php echo date('d-M-y'); ?></p>
                        </div>
                        <div class="icon" style="line-height: 100%;">
                            <i class="ion ion-social-youtube" style="font-size: 80%;"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info</a>
                    </div>
                    <div id="box5" class="small-box bg-info" onclick="box(this)">
                        <div class="inner">
                            <h5>Info Penilaian</h5>
                            <p><?php echo date('d-M-y'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-filing"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info</a>
                    </div>
                </div>

            </ul>
        </nav>
    </div>
</aside>

<!-- Auto Scroll -->
<script>
    setInterval(function() {
        if ($('.sidebar')[0].scrollTop + $('.sidebar')[0].clientHeight >= $('.sidebar')[0].scrollHeight) {
            setTimeout(function() {$('.sidebar')[0].scrollTop = 0;}, 2000);
        }else{
            $('.sidebar')[0].scrollTop = $('.sidebar')[0].scrollTop + 1.2;
        }
    }, 50);
</script>