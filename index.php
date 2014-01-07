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

function render_selector($active, $first_tid) {
    switch($active) {
    case "24h": $active_24h = "active"; break;
    case "30d": $active_30d = "active"; break;
    case "12m": $active_12m = "active"; break;
    }
    ?>
    <ul class="nav nav-pills pull-right time-selector-area">
      <li class="<?php echo $active_24h;?>"><a href="#" class="time-selector" data-tid="<?php echo $first_tid;?>">24 Hours</a></li>
      <li class="<?php echo $active_30d;?>"><a href="#" class="time-selector" data-tid="<?php echo $first_tid+1;?>">30 Days</a></li>
      <li class="<?php echo $active_12m;?>"><a href="#" class="time-selector" data-tid="<?php echo $first_tid+2;?>">12 Month</a></li>
    </ul>
    <?php
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
    <link href="style.css" rel="stylesheet">
<style>

</style>

</head>
<body>

<div class="navbar navbar-fixed-top" style="position: absolute;">
<div class="navbar-inner">
<div class="container" style="width: auto; padding: 0 20px;">
<a href="http://www.opensciencegrid.org"><img class="logo" src="osg.png"></a>
<span class="title pull-right">A national, distributed computing partnership for data-intensive research</span>
</div>
</div>
</div>

<div class="container-fluid">

<div class="row-fluid">
<div class="span9">

    <div class="content-out well well-small">

        <ul class="nav nav-tabs menu">
          <li class="active"><a id="tab-statusmap" href="#home" data-toggle="tab">Status Map</a></li>
          <li><a id="tab-job" href="#home" data-toggle="tab">Jobs</a></li>
          <li><a id="tab-cpu" href="#profile" data-toggle="tab">CPU Hours</a></li>
          <li><a id="tab-transfer" href="#messages" data-toggle="tab">Transfers</a></li>
          <li><a id="tab-tb" href="#settings" data-toggle="tab">TB Transferred</a></li>
        </ul>

        <div class="content">

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
                    <p class="caption">OSG currently consists of <?echo $info["num_sites"];?> sites across United States and abroad.</p>
                    <iframe src="<?php echo config()->rsvmap?>" frameborder="0"></iframe>
                  </div>

                  <div class="item" data-tabid="tab-job">
                    <?php render_selector("24h", 1)?>
                    <p class="caption">Each finished job on an OSG resource is reported to the central accounting system</p>
                    <img src="osg_display/jobs_hourly.png"></img>
                  </div>
                  <div class="item" data-tabid="tab-job">
                    <?php render_selector("30d", 1)?>
                    <p class="caption">Each finished job on an OSG resource is reported to the central accounting system</p>
                    <img src="osg_display/jobs_daily.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-job">
                    <?php render_selector("12m", 1)?>
                    <p class="caption">Each finished job on an OSG resource is reported to the central accounting system</p>
                    <img src="osg_display/jobs_monthly.png" alt="">
                  </div>

                  <div class="item" data-tabid="tab-cpu">
                    <?php render_selector("24h", 4)?>
                    <p class="caption">CPU hours spent on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/cpu_hours_hourly.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-cpu">
                    <?php render_selector("30d", 4)?>
                    <p class="caption">CPU hours spent on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/cpu_hours_daily.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-cpu">
                    <?php render_selector("12m", 4)?>
                    <p class="caption">CPU hours spent on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/cpu_hours_monthly.png" alt="">
                  </div>

                  <div class="item" data-tabid="tab-transfer">
                    <?php render_selector("24h", 7)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfers_hourly.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-transfer">
                    <?php render_selector("30d", 7)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfers_daily.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-transfer">
                    <?php render_selector("12m", 7)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfers_monthly.png" alt="">
                  </div>

                  <div class="item" data-tabid="tab-tb">
                    <?php render_selector("24h", 10)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfer_volume_hourly.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-tb">
                    <?php render_selector("30d", 10)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfer_volume_daily.png" alt="">
                  </div>
                  <div class="item" data-tabid="tab-tb">
                    <?php render_selector("12m", 10)?>
                    <p class="caption">Completed transfers on an OSG resource are reported to the central accounting system.</p>
                    <img src="osg_display/transfer_volume_monthly.png" alt="">
                  </div>

                </div>
                <a class="left carousel-control" href="#osgCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#osgCarousel" data-slide="next">&rsaquo;</a>
            </div><!--osgCarousel-->
        </div> <!--content-->
    
    </div><!--content well-->

</div><!--span8-->
<div class="span3">

    <div class="stats">
            <div class="well">
            <ul class="nav nav-list">
                <li class="head"><a href="#">In the last 24 Hours</a></li>
                <li><span class="stat-value"><?php echo format($info["jobs_hourly"]);?></span><span class="stat-label">Jobs</span></li>
                <li><span class="stat-value"><?php echo format($info["cpu_hours_hourly"]);?></span><span class="stat-label">CPU&nbsp;Hours</span></li>
                <li><span class="stat-value"><?php echo format($info["transfers_hourly"]);?></span><span class="stat-label">Transfers</span></li>
                <li><span class="stat-value"><?php echo format($info["transfer_volume_mb_hourly"]/1000000);?></span><span class="stat-label">TB&nbsp;Transfers</span></li>
                <li class="head"><a href="#">In the last 30 Days</a></li>
                <li><span class="stat-value"><?php echo format($info["jobs_daily"]);?></span><span class="stat-label">Jobs</span></li>
                <li><span class="stat-value"><?php echo format($info["cpu_hours_daily"]);?></span><span class="stat-label">CPU&nbsp;Hours</span></li>
                <li><span class="stat-value"><?php echo format($info["transfers_daily"]);?></span><span class="stat-label">Transfers</span></li>
                <li><span class="stat-value"><?php echo format($info["transfer_volume_mb_daily"]/1000000);?></span><span class="stat-label">TB&nbsp;Transfers</span></li>
                <li class="head"><a href="#">In the last 12 Month</a></li>
                <li><span class="stat-value"><?php echo format($info["jobs_monthly"]);?></span><span class="stat-label">Jobs</span></li>
                <li><span class="stat-value"><?php echo format($info["cpu_hours_monthly"]);?></span><span class="stat-label">CPU&nbsp;Hours</span></li>
                <li><span class="stat-value"><?php echo format($info["transfers_monthly"]);?></span><span class="stat-label">Transfers</span></li>
                <li><span class="stat-value"><?php echo format($info["transfer_volume_mb_monthly"]/1000000);?></span><span class="stat-label">TB&nbsp;Transfers</span></li>
            </ul>
            </div>
            <p class="stats-title">OSG delivered across <?php echo $info["num_sites"];?> sites</p>
    </div> <!--stats-->

</div><!--span4-->
</div><!--row-fluid-->
</div><!--container-fluid-->

<div class="footer">
    <div class="row-fluid">
        <div class="span4">
            <a href="http://science.energy.gov/"><img src="doe.png"></a>
        </div>
        <div class="span4">
        <p class="status-at">Status at <time class="timeago" datetime="<?php echo date("cZ", $json_time);?>"><?php echo date("cZ", $json_time);?></time></p>
        <p class="note">
            Data is loaded every <a href='https://twiki.grid.iu.edu/twiki/pub/Accounting/WebHome/2009_08_20_Gratia_buffering.pdf' target='_blank'>15 minutes</a>
        </p>
        </div>
        <div class="span4">
            <a href="http://nsf.gov/"><img src="nsf.png" class="pull-right"></a>
        </div>
    </div><!--row-fluid-->
</div><!--footer-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="jquery.timeago.js"></script>
<script>
$(function() {
    updateTimeago();
    $('.carousel').carousel({
        interval: 15000
    }).bind("slide", function(e) {
        var tabid = $(e.relatedTarget).data("tabid");
        $("#"+tabid).tab("show");
    });
    onresize(); 
    $(window).resize(function (){ onresize(); });

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
    $(".time-selector").click(function() {
        var tid = $(this).data("tid");
        $(".carousel").carousel(tid);
        return false;
    });

});

function onresize() {
    var h = $(window).height() - 310;
    $(".item iframe").each(function() {
        $(this).height(h);
    });
    $(".item img").each(function() {
        $(this).height(h);
    });

    //var fsize = wh/40;
    //console.log(fsize);
    //$(".stats").css("font-size", fsize);

    //var area = $(window).width() * $(window).height();
    //window.parent.document.body.style.zoom = area/2000000;

    if($(window).width() < 1000) {
        $(".title").hide();
    } else {
        $(".title").show();
    }

    var stats_width = $(".stats").width();
    var stats_fontsize = 6 + stats_width/30;
    $(".stats").css("font-size", stats_fontsize);
    var stats_valuepad = stats_width/100;
    $(".stat-value").css("padding-top", stats_valuepad);
    $(".stat-value").css("padding-bottom", stats_valuepad);
}

function updateTimeago() {
    $("time.timeago").timeago();
    setTimeout(updateTimeago, 30*1000);
}


</script>
</body>
</html>
