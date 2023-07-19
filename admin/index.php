<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital Talent</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Hakko Bio Richard ">
    <meta name="keywords" content="Perpus, Website, Aplikasi, Perpustakaan, Online">
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="../css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                Perpus Digital Talent
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['fullname']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>
                                    <li>
                                        <a href="detail-admin.php?hal=edit&kd=<?php echo $_SESSION['user_id'];?>">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                        Profile</a>
                                        <a href="admin.php">
                                        <i class="fa fa-cog fa-fw pull-right"></i>
                                        Settings</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                        <a href="../logout.php"><i class="fa fa-ban fa-fw pull-right"></i>
                                        Logout</a>
                                    </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../login.html"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<?php } ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div>
                        <center><img src="<?php echo $_SESSION['gambar']; ?>" height="80" width="80" class="img-circle" alt="User Image" style="border: 3px solid white;" /></center>
                    </div>
                    <div class="info">
                        <center><p><?php echo $_SESSION['fullname']; ?></p></center>
                    </div>
                </div>
                <?php include("menu.php"); ?>
            </section>
            <!-- /.sidebar -->
        </aside>
                
        <aside class="right-side">
            <!-- Main content -->
            <section class="content">
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-md-3">
                        <div class="sm-st clearfix">
                            <span class="sm-st-icon st-red"><i class="fa fa-user"></i></span>
                            <div class="sm-st-info">
                            <?php $tampil=mysqli_query($conn, "select * from data_anggota order by id desc");
                            $total=mysqli_num_rows($tampil);
                            ?>
                            <span><?php echo "$total"; ?></span>
                            Total Anggota
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sm-st clearfix">
                        <span class="sm-st-icon st-violet"><i class="fa fa-book"></i></span>
                        <div class="sm-st-info">
                        <?php $tampil=mysqli_query($conn, "select * from data_buku order by id desc");
                        $total1=mysqli_num_rows($tampil);
                        ?>
                        <span><?php echo "$total1"; ?></span>
                        Total Buku
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sm-st clearfix">
                    <span class="sm-st-icon st-blue"><i class="fa fa-refresh fa-spin fa-1x"></i></span>
                    <div class="sm-st-info">
                        <?php $tampil=mysqli_query($conn, "select * from trans_pinjam order by id desc");
                        $total2=mysqli_num_rows($tampil);
                            ?>
                        <span><?php echo "$total2"; ?></span>
                        Total Peminjaman Buku
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sm-st clearfix">
                    <span class="sm-st-icon st-green"><i class="fa fa-group"></i></span>
                    <div class="sm-st-info">
                        <?php $tampil=mysqli_query($conn, "select * from pengunjung order by id desc");
                        $total3=mysqli_num_rows($tampil);
                        ?>
                        <span><?php echo "$total3"; ?></span>
                        Total Pengunjung
                    </div>
                </div>
            </div>
            
    <!-- Main row -->
    <div class="row">
    <div class="col-md-8">
        <!--earning graph start-->
        <section class="panel">
            <header class="panel-heading">
                Grafik Peminjaman Buku
            </header>
            <div class="panel-body">
                <canvas id="linechart" width="600" height="330"></canvas>
            </div>
            </section>
            <!--earning graph end-->
    </div>
    <div class="col-lg-4">
    <!--chat start-->
    <section class="panel">
        <header class="panel-heading">
            Pemberitahuan
        </header>
            <div class="panel-body" id="noti-box">
            <?php
            $tampil=mysqli_query($conn, "select * from data_anggota order by id desc limit 1");
            while($data2=mysqli_fetch_array($tampil)){
            ?>
            <div class="alert alert-block alert-danger">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong><?php echo $data2['nama'];?></strong>, Telah terdaftar menjadi anggota perpustakaan.
            </div>
            <?php } ?>                        
        <?php
        $tampil=mysqli_query($conn, "select * from admin order by user_id desc limit 1");
        while($data3=mysqli_fetch_array($tampil)){
        ?>
    <div class="alert alert-success">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <strong><?php echo $data3['fullname']; ?></strong>, Telah ditambahkan menjadi admin Perpustakaan yang baru. 
    </div>
    <?php } ?>
    <?php
    $tampil=mysqli_query($conn, "select * from data_buku order by id desc limit 1");
    while($data4=mysqli_fetch_array($tampil)){
    ?>
    <div class="alert alert-info">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <strong><?php echo $data4['judul']; ?></strong>, Buku bacaan baru yang ada di Perpustakaan Digital Talent.
    </div>
    <?php } ?>    
    <?php
    $tampil=mysqli_query($conn, "select * from pengunjung order by id desc limit 1");
    while($data5=mysqli_fetch_array($tampil)){
    ?>   
    <div class="alert alert-warning">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        <strong><?php echo $data5['nama']; ?> </strong> Pengunjung baru di Perpustakaan Digital Talent.
    </div>
    <?php } ?>
    </div>
    </section>
    </div>
    </div> 
    <div class="row">
    <div class="col-md-5">
        <div class="panel">
            <header class="panel-heading">
                Daftar Anggota Baru
            </header><?php
    $tampil=mysqli_query($conn, "select * from data_anggota order by id desc limit 3");
    while($data1=mysqli_fetch_array($tampil)){
    ?>
    <ul class="list-group teammates">
        <li class="list-group-item">
            <a href="anggota.php"><img src="<?php echo $data1['foto']; ?>" width="50" height="50" style="border: 3px solid #555555;"></a>
            <a href="anggota.php"><?php echo $data1['nama']; ?></a>
        </li>
    </ul>
    <?php } ?>
    <div class="panel-footer bg-white">
        <!-- <span class="pull-right badge badge-info">32</span> -->
        <a href="anggota.php" class="btn btn-sm btn-info">Data Anggota <i class="fa fa-plus"></i></a>
    </div>
    </div>
    </div>
    <div class="col-md-7">
    <section class="panel tasks-widget">
        <header class="panel-heading">
            Daftar Bacaan Perpustakaan Digital Talent
        </header>
        <div class="panel-body">

        <div class="task-content">
        <ul class="task-list">
        <?php
        $tampil=mysqli_query($conn, "select * from data_buku order by id desc limit 5");
        while($data6=mysqli_fetch_array($tampil)){
        ?>
    <li>
    <div class="task-checkbox">
        <!-- <input type="checkbox" class="list-child" value=""  /> -->
        <input type="checkbox" class="flat-grey list-child"/>
        <!-- <input type="checkbox" class="square-grey"/> -->
    </div>
    <div class="task-title">
        <span class="task-title-sp"><?php echo $data6['judul']; ?></span>
        <span class="label label-primary"><?php echo $data6['tgl_input']; ?></span>
        <div class="pull-right hidden-phone">
            <button class="btn btn-info btn-xs"><i class="fa fa-check"></i></button>
            <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
        </div>
    </div>
    </li>     
    <?php } ?>
    </ul>
</div>

    <div class=" add-task-row">
        <a class="btn btn-warning btn-sm pull-left" href="buku.php">Lihat Buku Bacaan</a>
        <!--<a class="btn btn-default btn-sm pull-right" href="#">See All Tasks</a>-->
    </div>
    </div>
    </section>
    </div>
    </div>
    <!-- row end -->
    </section><!-- /.content -->
    <div class="footer-main">
        Copyright &copy <a href="index.php">Perpustakaan Digital Talent</a> 2023</div>
        </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="../js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="../js/plugins/chart.js" type="text/javascript"></script>

        <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="../js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="../js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="../js/Director/dashboard.js" type="text/javascript"></script>

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
            $('#noti-box').slimScroll({
                height: '400px',
                size: '5px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
</script>
<script type="text/javascript">
    $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
                responsive : true,
                maintainAspectRatio: false,
            });

            });
            // Chart.defaults.global.responsive = true;
</script>
</body>
</html>