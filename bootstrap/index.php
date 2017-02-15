  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <title>Test</title>
            </head>
            <body>

            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />

            <!-- Styles -->
            <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet" />
            <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet" />

            <style>

            /* GLOBAL STYLES
            -------------------------------------------------- */
            /* Padding below the footer and lighter body text */

            body {
             padding-bottom: 40px;
             color: #5a5a5a;
             color: #fff;
             background-color:#96232d;
             background:#96232d;
             font-family: "PT Sans";
            }
            h1, h2, h3{font-style: italic}
            .red_gradient {
             background: #ce4d4a; /* Old browsers */
             background: -moz-linear-gradient(top,  #ce4d4a 0%, #96232d 100%); /* FF3.6+ */
             background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ce4d4a), color-stop(100%,#96232d)); /* Chrome,Safari4+ */
             background: -webkit-linear-gradient(top,  #ce4d4a 0%,#96232d 100%); /* Chrome10+,Safari5.1+ */
             background: -o-linear-gradient(top,  #ce4d4a 0%,#96232d 100%); /* Opera 11.10+ */
             background: -ms-linear-gradient(top,  #ce4d4a 0%,#96232d 100%); /* IE10+ */
             background: linear-gradient(to bottom,  #ce4d4a 0%,#96232d 100%); /* W3C */
             filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ce4d4a', endColorstr='#96232d',GradientType=0 ); /* IE6-9 */
             position: relative;
            }


            .btn-renew {
             color: #ffffff;
             text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);
             background-color: #006dcc;
             *background-color: #ce4d4a;
             background-image: -moz-linear-gradient(top, #ce4d4a, #96232d);
             background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ce4d4a), to(#96232d));
             background-image: -webkit-linear-gradient(top, #ce4d4a, #96232d);
             background-image: -o-linear-gradient(top, #ce4d4a, #96232d);
             background-image: linear-gradient(to bottom, #ce4d4a, #96232d);
             background-repeat: repeat-x;
             border-color: #96232d;
             padding-left: 50px;
             padding-right: 50px;
            }

            .btn-renew:hover,
            .btn-renew:active,
            .btn-renew.active,
            .btn-renew.disabled,
            .btn-renew[disabled] {
             color: #ffffff;
             background-color: #96232d;
             *background-color: #ce4d4a;
            }

            .btn-renew:active,
            .btn-renew.active {
             background-color: #ce4d4a;
            }

            .text_center{text-align: center; background}

            .green_stripe {height: 10px; background-color: #004e26; border-top: 2px solid #fff; border-bottom: 2px solid #fff; margin-bottom: 30px; width: 100%;}

            /* CUSTOMIZE THE NAVBAR
            -------------------------------------------------- */

            /* Special class on .container surrounding .navbar, used for positioning it into place. */
            .navbar-wrapper {
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             z-index: 10;
             margin-top: 20px;
             margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
            }
            .navbar-wrapper .navbar {

            }

            /* Remove border and change up box shadow for more contrast */
            .navbar .navbar-inner {
             border: 0;
             -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
                -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
                     box-shadow: 0 2px 10px rgba(0,0,0,.25);
                     background: rgba(255,255,255,.4);
            }

            /* Downsize the brand/project name a bit */
            .navbar .brand {
             padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
             font-size: 16px;
             font-weight: bold;
             text-shadow: 0 -1px 0 rgba(0,0,0,.5);
            }

            /* Navbar links: increase padding for taller navbar */
            .navbar .nav > li > a {
             padding: 15px 20px;
             font-size: 18px;
             font-family: 'Oswald';
             letter-spacing: 1px;
             font-weight: 300;
            }

            /* Offset the responsive button for proper vertical alignment */
            .navbar .btn-navbar {
             margin-top: 10px;
             margin-bottom: 10px;
            }


            /* CUSTOMIZE THE NAVBAR
            -------------------------------------------------- */

            /* Carousel base class */
            .carousel {
             margin-bottom: 0px;
            }

            .carousel .container {
             position: relative;
             z-index: 9;
            }

            .carousel-control {
             height: 80px;
             margin-top: 0;
             font-size: 120px;
             text-shadow: 0 1px 1px rgba(0,0,0,.4);
             background-color: transparent;
             border: 0;
            }

            .carousel .item .container.header{
             height: 600px;
            }
            .carousel img.header_image {
             position: absolute;
             top: 0;
             left: 0;
             min-width: 100%;
             min-height: 600px;
             opacity: 1;
            }

            .carousel-caption {
             background-color: transparent;
             position: static;
             max-width: 550px;
             padding: 0 20px;
             margin-top: 200px;
            }
            .carousel-caption h1,
            .carousel-caption .lead {
             margin: 0;
             line-height: 1.25;
             color: #fff;
             text-shadow: 0 1px 1px rgba(0,0,0,.4);
            }
            .carousel-caption .btn {
             margin-top: 10px;
            }



            /* RESPONSIVE CSS
            -------------------------------------------------- */

            @media (max-width: 979px) {

             .container.navbar-wrapper {
               margin-bottom: 0;
               width: auto;
             }
             .navbar-inner {
               border-radius: 0;
               margin: -20px 0;
             }

             .carousel .item .container.header{
               height: 600px;
             }
             .carousel img.header_image {
               height: auto;
             }

             .featurette {
               height: auto;
               padding: 0;
             }
             .featurette-image.pull-left,
             .featurette-image.pull-right {
               display: block;
               float: none;
               max-width: 40%;
               margin: 0 auto 20px;
             }
            }


            @media (max-width: 767px) {

             .navbar-inner {
               margin: -20px auto;
               padding: auto 0;
             }

             .carousel {
               margin-left: -20px;
               margin-right: -20px;
             }
             .carousel .container {

             }
             .carousel .item .container.header{
              height: auto;
              min-height: 400px; 
             }
             .carousel img.header_image {
               height: auto;
               max-height: auto;
               min-height: auto;
               min-width: 600px
             }
             .carousel-caption {
               width: 65%;
               padding: 0 70px;
               margin-top: 100px;
             }
             .carousel-caption h1 {
               font-size: 30px;
             }
             .carousel-caption .lead,
             .carousel-caption .btn {
               font-size: 18px;
             }

             .marketing .span4 + .span4 {
               margin-top: 40px;
             }

             .featurette-heading {
               font-size: 30px;
             }
             .featurette .lead {
               font-size: 18px;
               line-height: 1.5;
             }
             .btn-renew {
             padding-left: 20px;
             padding-right: 20px;
             }

            }
            </style>

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
             <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css' />
            <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
            <!-- Fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png" />
            <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png" />

            <!-- NAVBAR
            ================================================== -->
            <div class="navbar-wrapper">
             <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
             <div class="container">

               <div class="navbar navbar-inverse">
                 <div class="navbar-inner">
                   <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                   <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                   </a>
                 </div><!-- /.navbar-inner -->
               </div><!-- /.navbar -->

             </div> <!-- /.container -->
            </div><!-- /.navbar-wrapper -->



            <!-- Carousel
            ================================================== -->
            <div id="headerCarousel" class="carousel slide">
             <div class="carousel-inner">
               <div class="item active" data-title="Home">
               <img class="header_image" src="http://wallpaperspoint.net/wp-content/walls/9_landscape_wallpaper_03/autumn-forest-landscape-wallpaper.jpg" alt="" />
                   <div class="container header">
                   <div class="carousel-caption">
                     <h1>&nbsp&nbspText Text, <br />&nbspText Text<br />Text Text...</h1>
                     <!--<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>-->
                   </div>
                   </div>

               <div class="red_gradient"> 
               <div class="row-fluid green_stripe"></div>
               <div class="container">
                   <div class="row-fluid">
                   <div class="span6">
                       <h1>Home</h1>
                       <p>Lorem ipsum dolor sit amet, maiores ornare ac fermentum, imperdiet ut vivamus a, nam lectus at nunc. Quam euismod sem, semper ut potenti pellentesque quisque. In eget sapien sed, sit duis vestibulum ultricies, placerat morbi amet vel, nullam in in lorem vel. In molestie elit dui dictum, praesent nascetur pulvinar sed, in dolor pede in aliquam, risus nec error quis pharetra. Eros metus quam augue suspendisse, metus rutrum risus erat in.  In ultrices quo ut lectus, etiam vestibulum urna a est, pretium luctus euismod nisl, pellentesque turpis hac ridiculus massa. Venenatis a taciti dolor platea, curabitur lorem platea urna odio, convallis sit pellentesque lacus  proin. Et ipsum velit diam nulla, fringilla vel tincidunt vitae, elit turpis tellus vivamus, dictum adipiscing convallis magna id. Viverra eu amet sit, dignissim tincidunt volutpat nulla tincidunt, feugiat est erat dui tempor, fusce tortor auctor vestibulum. Venenatis praesent risus orci, ante nam volutpat erat. Cursus non mollis interdum maecenas, consequat imperdiet penatibus enim, tristique luctus tellus eos accumsan, ridiculus erat laoreet nunc.</p>
                   </div>
                   </div>
               </div>
               </div>

               </div>
               <div class="item" data-title="Page 2">
                 <img class="header_image" src="http://wallpaperspoint.net/wp-content/walls/9_landscape_wallpaper_03/autumn-forest-landscape-wallpaper.jpg" alt="" />
                   <div class="container header">
                   <div class="carousel-caption">
                     <h1>&nbsp&nbspText Text, <br />&nbspText Text<br />Text Text...</h1>
                     <!--<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>-->
                   </div>
                   </div>

               <div class="red_gradient"> 
               <div class="row-fluid green_stripe"></div>
               <div class="container">
                   <div class="row-fluid">
                   <div class="span6">
                       <h1>Page 2</h1>
                       <p>Lorem ipsum dolor sit amet, maiores ornare ac fermentum, imperdiet ut vivamus a, nam lectus at nunc. Quam euismod sem, semper ut potenti pellentesque quisque. In eget sapien sed, sit duis vestibulum ultricies, placerat morbi amet vel, nullam in in lorem vel. In molestie elit dui dictum, praesent nascetur pulvinar sed, in dolor pede in aliquam, risus nec error quis pharetra. Eros metus quam augue suspendisse, metus rutrum risus erat in.  In ultrices quo ut lectus, etiam vestibulum urna a est, pretium luctus euismod nisl, pellentesque turpis hac ridiculus massa. Venenatis a taciti dolor platea, curabitur lorem platea urna odio, convallis sit pellentesque lacus  proin. Et ipsum velit diam nulla, fringilla vel tincidunt vitae, elit turpis tellus vivamus, dictum adipiscing convallis magna id. Viverra eu amet sit, dignissim tincidunt volutpat nulla tincidunt, feugiat est erat dui tempor, fusce tortor auctor vestibulum. Venenatis praesent risus orci, ante nam volutpat erat. Cursus non mollis interdum maecenas, consequat imperdiet penatibus enim, tristique luctus tellus eos accumsan, ridiculus erat laoreet nunc.</p>
                   </div>
                   </div>
               </div>
               </div>

               </div>
               <div class="item" data-title="Page 3">
                 <img class="header_image" src="http://wallpaperspoint.net/wp-content/walls/9_landscape_wallpaper_03/autumn-forest-landscape-wallpaper.jpg" alt="" />
                   <div class="container header">
                   <div class="carousel-caption">
                     <h1>&nbsp&nbspText Text, <br />&nbspText Text<br />Text Text...</h1>
                     <!--<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>-->
                   </div>
                   </div>

               <div class="red_gradient"> 
               <div class="row-fluid green_stripe"></div>
               <div class="container">
                   <div class="row-fluid">
                   <div class="span6">
                       <h1>Page 3</h1>
                       <p>Lorem ipsum dolor sit amet, maiores ornare ac fermentum, imperdiet ut vivamus a, nam lectus at nunc. Quam euismod sem, semper ut potenti pellentesque quisque. In eget sapien sed, sit duis vestibulum ultricies, placerat morbi amet vel, nullam in in lorem vel. In molestie elit dui dictum, praesent nascetur pulvinar sed, in dolor pede in aliquam, risus nec error quis pharetra. Eros metus quam augue suspendisse, metus rutrum risus erat in.  In ultrices quo ut lectus, etiam vestibulum urna a est, pretium luctus euismod nisl, pellentesque turpis hac ridiculus massa. Venenatis a taciti dolor platea, curabitur lorem platea urna odio, convallis sit pellentesque lacus  proin. Et ipsum velit diam nulla, fringilla vel tincidunt vitae, elit turpis tellus vivamus, dictum adipiscing convallis magna id. Viverra eu amet sit, dignissim tincidunt volutpat nulla tincidunt, feugiat est erat dui tempor, fusce tortor auctor vestibulum. Venenatis praesent risus orci, ante nam volutpat erat. Cursus non mollis interdum maecenas, consequat imperdiet penatibus enim, tristique luctus tellus eos accumsan, ridiculus erat laoreet nunc.</p>
                   </div>
                   </div>
               </div>
               </div>

               </div>
             </div>
             <a class="left carousel-control" href="#headerCarousel" data-slide="prev">&lsaquo;</a>
             <a class="right carousel-control" href="#headerCarousel" data-slide="next">&rsaquo;</a>
            </div><!-- /.carousel -->
            </div>

            <!-- /.container -->



            <!-- Javascript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="http://twitter.github.com/bootstrap/assets/js/jquery.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-scrollspy.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tab.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-button.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-collapse.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-carousel.js"></script>
            <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-typeahead.js"></script>   
            <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>

            <script type="text/javascript" charset="utf-8">
             !function ($) {
               $(function(){
                 // carousel demo
                 $('#headerCarousel').carousel({
                           interval: false
                       })
               })
             }(window.jQuery)
            </script> 

            <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {  
              $("#headerCarousel").swiperight(function() {  
                 $("#headerCarousel").carousel('prev');  
               });  
              $("#headerCarousel").swipeleft(function() {  
                 $("#headerCarousel").carousel('next');  
              });
            });
            </script> 
            <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {  
               $('.carousel[id]').each(function() {
                   var html = '<div class="nav-collapse collapse" data-target="' + $(this).attr('id') + '"><ul class="nav">';
                       for(var i = 0; i < $(this).find('.item').size(); i ++) {
                           html += '<li';
                               if(i == 0) {
                                   html += ' class="active"';
                               }
                               var item = $(this).find('.item').get(i);
                                   html += '><a href="#">'  + $(item).attr('data-title') + '</a></li>';
                               }                                    
                               html += '</ul></li>';
                               $('.btn-navbar').after(html);
                               $('.carousel-control.left[href="#' + $(this).attr('id') + '"]').hide();

                   }).bind('slid', function(e) {
                       var nav = $('.nav-collapse[data-target="' + $(this).attr('id') + '"] ul');
                       var index = $(this).find('.item.active').index();
                       var item = nav.find('li').get(index);

                       nav.find('li.active').removeClass('active');
                       $(item).find('li').addClass('active');

                       var nav = $('.carousel-nav[data-target="' + $(this).attr('id') + '"] ul');
                       var index = $(this).find('.item.active').index();
                       var item = nav.find('li').get(index);
                       nav.find('li a.active').removeClass('active');
                       $(item).find('a').addClass('active');

                       if(index == 0) {
                           $('.carousel-control.left[href="#' + $(this).attr('id') + '"]').fadeOut();
                       } else {
                           $('.carousel-control.left[href="#' + $(this).attr('id') + '"]').fadeIn();
                       }

                       if(index == nav.find('li').size() - 1) {
                           $('.carousel-control.right[href="#' + $(this).attr('id') + '"]').fadeOut();
                       } else {
                           $('.carousel-control.right[href="#' + $(this).attr('id') + '"]').fadeIn();
                       }

                   });

                   $('.nav a').bind('click', function(e) {
                       var index = $(this).parent().index();
                       var carousel = $('#' + $(this).closest('.nav-collapse').attr('data-target'));

                       carousel.carousel(index);
                       e.preventDefault();
                   });
            });


            </script>

            </body>
            </html>