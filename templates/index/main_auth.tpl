<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Creative - Bootstrap Admin Template</title>

    <!-- Bootstrap CSS -->
    <link href="/design/web/NiceAdmin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="/design/web/NiceAdmin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="/design/web/NiceAdmin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="/design/web/NiceAdmin/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="/design/web/NiceAdmin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/design/web/NiceAdmin/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="/design/web/NiceAdmin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="/design/web/NiceAdmin/css/owl.carousel.css" type="text/css">
    <link href="/design/web/NiceAdmin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="/design/web/NiceAdmin/css/fullcalendar.css">
    <link href="/design/web/NiceAdmin/css/widgets.css" rel="stylesheet">
    <link href="/design/web/NiceAdmin/css/style.css" rel="stylesheet">
    <link href="/design/web/NiceAdmin/css/style-responsive.css" rel="stylesheet" />
    <link href="/design/web/NiceAdmin/css/xcharts.min.css" rel=" stylesheet">
    <link href="/design/web/NiceAdmin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- =======================================================
      Theme Name: NiceAdmin
      Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->

    <!-- javascripts -->
    <script src="/design/web/NiceAdmin/js/jquery.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery-ui-1.10.4.min.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery-1.8.3.min.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
    <!-- bootstrap -->
    <script src="/design/web/NiceAdmin/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="/design/web/NiceAdmin/js/jquery.scrollTo.min.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="/design/web/NiceAdmin/assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="/design/web/NiceAdmin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="/design/web/NiceAdmin/js/owl.carousel.js"></script>
    <!-- jQuery full calendar -->
    <script src="/design/web/NiceAdmin/js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="/design/web/NiceAdmin/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="/design/web/NiceAdmin/js/calendar-custom.js"></script>
    <script src="/design/web/NiceAdmin/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="/design/web/NiceAdmin/js/jquery.customSelect.min.js"></script>
    <script src="/design/web/NiceAdmin/assets/chart-master/Chart.js"></script>
    {if false}<script src="/js/datetimepicker/jquery.datetimepicker.js" type="text/javascript"></script>
    <link href="/js/datetimepicker/jquery.datetimepicker.css" media="all" rel="stylesheet" />{/if}
    <script src="/js/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <link href="/js/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css"" media="all" rel="stylesheet" />

    {foreach item = tabItem from = $JSControllers}
        <script src="{$tabItem}"></script>
    {/foreach}

    <!--custome script for all page-->
    <script src="/design/web/NiceAdmin/js/scripts.js"></script>
    <script>
        //knob
        $(function() {
            $(".knob").knob({
                'draw': function() {
                    $(this.i).val(this.cv + '%')
                }
            })
        });

        //carousel
        $(document).ready(function() {
            $("#owl-slider").owlCarousel({
                navigation: true,
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true

            });
        });

        //custom select box

        $(function() {
            $('select.styled').customSelect();
        });

    </script>
</head>

<body>
<!-- container section start -->
<section id="container" class="">


    <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>

        <!--logo start-->
        <a href="/" class="logo">Тестовое <span class="lite">Задание</span></a>
        <!--logo end-->


        <div class="top-nav notification-row">
            <!-- notificatoin dropdown start-->
            <ul class="nav pull-right top-menu">
            </ul>
            <!-- notificatoin dropdown end-->
        </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="active">
                    <a class="" href="/operations">
                        <i class="icon_house_alt"></i>
                        <span>Финансы</span>
                    </a>
                </li>
                <li>
                    <a class="" href="/logout">
                        <i class="icon_key_alt"></i>
                        <span>Выход</span>
                    </a>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/">Главная</a></li>
                        <li><i class="fa fa-laptop"></i>Финансы</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {$menuName}
                        </div>
                        <div class="panel-body">
                            {include file=$subTemplate}
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <div class="text-right">
            <div class="credits">
                <!--  -->
            </div>
        </div>
    </section>
    <!--main content end-->
</section>
<!-- container section start -->


</body>

</html>
