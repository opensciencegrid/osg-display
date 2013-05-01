<?php
require_once("site_config.php");
$json_file = "osg_display/display.json";
$json_time = filemtime($json_file);
$json = file_get_contents($json_file);
$json = str_replace("'", "\"", $json);
$info = json_decode($json, true);

function format($num) {
    if($num > 100000) {
        $num = round($num, -3);
    }
    return number_format($num);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="300"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Displays current OSG stasitics">
    <meta name="author" content="Soichi Hayashi">

    <title>OSG Display</title>

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-default/css/bootstrap-responsive.min.css" rel="stylesheet">
<style>
html {
height: 100%;
}
body {
position: relative;
height: 100%;
font-size: 15pt;
}
.container-fluid {
padding-top: 65px;
height: 100%;
box-sizing: border-box;
padding-bottom: 80px;
}
.navbar-inner img.logo {
padding: 5px 0px;
height: 50px;
}
.navbar-inner .title {
padding-top: 20px;
text-align: right;
color: #666;
}
.nav {
margin-bottom: 3px;
}
.carousel-caption {
position: relative;
background-color: #fff;
height: 60px;
}
.carousel-caption h4 {
color: #444;
font-size: 120%;
}
.carousel-caption p {
color: #666;
}
.carousel .item iframe {
width: 100%;
}
.carousel .item > img {
margin: 0px auto;
display: block;
margin-bottom: 10px;
}
.stats {
margin-top: 15px;
}
.stats th.head {
background-color: #555;
box-shadow:0px 0px 10px #333 inset;
color: white;
}
.stats td.stat-value {
text-align: right;
}
.stats td.stat-label {
color: #999;
}
.footer {
width: 100%;
height: 80px;
background-color: #222;
position: absolute;
bottom: 0px;
display: block;
box-shadow:0px 0px 10px #000 inset;
}
.footer img {
padding: 5px;
height: 70px;
}
.footer p {
margin-bottom: 5px;
font-size: 90%;
}
.footer .status-at {
color: #ccc;
margin-top: 18px;
text-align: center;
}
.footer .note {
color: #666;
text-align: center;
}
</style>

</head>
<body>

<div class="navbar navbar-fixed-top" style="position: absolute;">
<div class="navbar-inner">
<div class="container" style="width: auto; padding: 0 20px;">
<img class="logo" src="osg.png">
<span class="title pull-right">A national, distributed computing partnership for data-intensive research</span>
</div>
</div>
</div>

<div class="container-fluid">
<div class="row-fluid">

<div class="span9">
<ul class="nav nav-pills">
  <li class="active"><a id="tab-statusmap" href="#home" data-toggle="tab">Status Map</a></li>
  <li><a id="tab-job" href="#home" data-toggle="tab">Jobs</a></li>
  <li><a id="tab-cpu" href="#profile" data-toggle="tab">CPU Hours</a></li>
  <li><a id="tab-transfer" href="#messages" data-toggle="tab">Transfers</a></li>
  <li><a id="tab-tb" href="#settings" data-toggle="tab">TB Transferred</a></li>
</ul>
<div id="osgCarousel" class="carousel slide">
    <!--
    <ol class="carousel-indicators">
      <li data-target="#osgCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#osgCarousel" data-slide-to="1"></li>
      <li data-target="#osgCarousel" data-slide-to="2"></li>
      <li data-target="#osgCarousel" data-slide-to="3"></li>
    </ol>
    -->
    <div class="carousel-inner">
          <div class="item active" data-tabid="tab-statusmap">
            <iframe src="<?php echo config()->rsvmap?>" frameborder="0"></iframe>
            <div class="carousel-caption">
              <h4>RSV Status Map</h4>
              <p>OSG currently consists of <?echo $info["num_sites"];?> sites across United States and aboroad.</p>
            </div>
          </div>

          <div class="item" data-tabid="tab-job">
            <img src="osg_display/jobs_hourly.png" alt="">
            <div class="carousel-caption">
              <h4>Completed Jobs per hour in the Last 24 Hours</h4>
              <p>Each finished job on an OSG resource is reported to the central accounting system</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-job">
            <img src="osg_display/jobs_daily.png" alt="">
            <div class="carousel-caption">
              <h4>Completed Jobs per hour in the Last 30 Days</h4>
              <p>Each finished job on an OSG resource is reported to the central accounting system</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-job">
            <img src="osg_display/jobs_monthly.png" alt="">
            <div class="carousel-caption">
              <h4>Completed Jobs per hour in the Last Year</h4>
              <p>Each finished job on an OSG resource is reported to the central accounting system</p>
            </div>
          </div>

          <div class="item" data-tabid="tab-cpu">
            <img src="osg_display/cpu_hours_hourly.png" alt="">
            <div class="carousel-caption">
              <h4>CPU Hours in the Last 24 Hours</h4>
              <p>CPU hours spent on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-cpu">
            <img src="osg_display/cpu_hours_daily.png" alt="">
            <div class="carousel-caption">
              <h4>CPU Hours in the Last 30 Days</h4>
              <p>CPU hours spent on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-cpu">
            <img src="osg_display/cpu_hours_monthly.png" alt="">
            <div class="carousel-caption">
              <h4>CPU Hours in the Last Year</h4>
              <p>CPU hours spent on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>

          <div class="item" data-tabid="tab-transfer">
            <img src="osg_display/transfers_hourly.png" alt="">
            <div class="carousel-caption">
              <h4>Data Transfers in the Last 24 Hours</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-transfer">
            <img src="osg_display/transfers_daily.png" alt="">
            <div class="carousel-caption">
              <h4>Data Transfers in the Last 30 Days</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-transfer">
            <img src="osg_display/transfers_monthly.png" alt="">
            <div class="carousel-caption">
              <h4>Data Transfers in the Last Year</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>

          <div class="item" data-tabid="tab-tb">
            <img src="osg_display/transfer_volume_hourly.png" alt="">
            <div class="carousel-caption">
              <h4>Terabytes moved in the Last 24 Hours</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-tb">
            <img src="osg_display/transfer_volume_daily.png" alt="">
            <div class="carousel-caption">
              <h4>Petabytes moved in the Last 30 Days</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>
          <div class="item" data-tabid="tab-tb">
            <img src="osg_display/transfer_volume_monthly.png" alt="">
            <div class="carousel-caption">
              <h4>Petabytes moved in the Last Year</h4>
              <p>Completed transfers on an OSG resource are reported to the central accounting system.</p>
            </div>
          </div>

        </div>
        <a class="left carousel-control" href="#osgCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#osgCarousel" data-slide="next">&rsaquo;</a>
    </div><!--osgCarousel-->
</div> <!-- span -->

<div class="span3">
    <div class="stats well">
    <p>OSG delivered across <?php echo $info["num_sites"];?> sites</p>
    <table class="table">
    <tr><th colspan="2" class="head">In the last 24 Hours</th></tr>
    <tr><td class="stat-value"><?php echo format($info["jobs_hourly"]);?></td><td class="stat-label">Jobs</td></tr>
    <tr><td class="stat-value"><?php echo format($info["cpu_hours_hourly"]);?></td><td class="stat-label">CPU&nbsp;Hours</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfers_hourly"]);?></td><td class="stat-label">Transfers</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfer_volume_mb_hourly"]/1000000);?></td><td class="stat-label">TB&nbsp;Transfers</td></tr>
    <tr><th colspan="2" class="head">In the last 30 Days</th></tr>
    <tr><td class="stat-value"><?php echo format($info["jobs_daily"]);?></td><td class="stat-label">Jobs</td></tr>
    <tr><td class="stat-value"><?php echo format($info["cpu_hours_daily"]);?></td><td class="stat-label">CPU&nbsp;Hours</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfers_daily"]);?></td><td class="stat-label">Transfers</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfer_volume_mb_daily"]/1000000);?></td><td class="stat-label">TB&nbsp;Transfers</td></tr>
    <tr><th colspan="2" class="head">In the last Year</th></tr>
    <tr><td class="stat-value"><?php echo format($info["jobs_monthly"]);?></td><td class="stat-label">Jobs</td></tr>
    <tr><td class="stat-value"><?php echo format($info["cpu_hours_monthly"]);?></td><td class="stat-label">CPU&nbsp;Hours</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfers_monthly"]);?></td><td class="stat-label">Transfers</td></tr>
    <tr><td class="stat-value"><?php echo format($info["transfer_volume_mb_monthly"]/1000000);?></td><td class="stat-label">TB&nbsp;Transfers</td></tr>
    </table>
    </div><!--well-->
</div> <!--span-->

</div> <!--row-->
</div> <!--content-->

<div class="footer">
<div class="row-fluid">
<div class="span4">
    <img src="doe.png">
</div>
<div class="span4">
<p class="status-at">Status at <time class="timeago" datetime="<?php echo date("cZ", $json_time);?>"><?php echo date("cZ", $json_time);?></time></p>
<p class="note">
    Data is loaded every <a href='https://twiki.grid.iu.edu/twiki/pub/Accounting/WebHome/2009_08_20_Gratia_buffering.pdf' target='_blank'>15 minutes</a>
</p>
</div>
<div class="span4">
    <img src="nsf.png" class="pull-right">
</div>
</div><!--footer-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="jquery.timeago.js"></script>
<script>
$(function() {
    updateTimeago();
    $('.carousel').carousel().bind("slide", function(e) {
        var tabid = $(e.relatedTarget).data("tabid");
        $("#"+tabid).tab("show");
    });
    set_itemheight(); 
    $(window).resize(function (){ set_itemheight(); });

    $("#tab-statusmap").click(function() {
        $(".carousel").carousel(0);
    })
    $("#tab-job").click(function() {
        $(".carousel").carousel(1);
    })
    $("#tab-cpu").click(function() {
        $(".carousel").carousel(4);
    })
    $("#tab-transfer").click(function() {
        $(".carousel").carousel(7);
    })
    $("#tab-tb").click(function() {
        $(".carousel").carousel(10);
    })

});

function set_itemheight() {
    var wh = $(".container-fluid").height();
    var ch = $(".active .carousel-caption").height();
    var fh = $(".footer").height();
    $(".item iframe").height(wh-ch-fh+10);//img has margin-bottom 10px
    $(".item img").height(wh-ch-fh);

    //var fsize = wh/40;
    //console.log(fsize);
    //$(".stats").css("font-size", fsize);
}

function updateTimeago() {
    $("time.timeago").timeago();
    setTimeout(updateTimeago, 30*1000);
}

</script>
</body>
</html>
