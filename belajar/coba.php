
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr">
    <head>	<title>CSS 3D Folding Animation Example</title>
        <meta name="description" content="This effect uses 3D CSS animations which makes the animation even more sexy, and to make it red host, the animation requires no JavaScript!" />
        <link rel="stylesheet" href="/wp-content/themes/jack/css/all.css" type="text/css" />
        <style>

            nav .search {
                display: none;
            }

            .demoFrame header,
            .demoFrame .footer,
            .demoFrame h1,
            .demoFrame .p {
                display: none !important;
            }

            h1 {
                font-size: 2.6em;
            }

            h2, h3 {
                font-size: 1.7em;
            }

            .left {
                width: 920px !important;
                padding-bottom: 40px;
            }
            div.p {
                font-size: .8em;
                font-family: arial;
                margin-top: -20px;
                font-style: italic;
                padding: 10px 0;
            }

            .footer {
                padding: 20px;
                margin: 20px 0 0 0;
                background: #f8f8f8;
                font-weight: bold;
                font-family: arial;
                border-top: 1px solid #ccc;
            }

            .left > p:first-of-type { 
                background: #ffd987; 
                font-style: italic; 
                padding: 5px 10px; 
                margin-bottom: 40px;
            }

            .demoAds {
                position: absolute;
                top: 0;
                right: 0;
                width: 270px;
                padding: 10px 0 0 10px;
                background: #f8f8f8;
            }
            .demoAds a {
                margin: 0 10px 10px 0 !important;
                display: inline-block !important;
            }

            #promoNode { 
                margin: 20px 0; 
            }
        </style>	<style type="text/css">
            /* Static state */
            #container 	{ 
                width: 400px; 
                height: 400px; 
                position: relative; 
                border: 1px solid #ccc; 
                background: url(GoogleTestDW.png) 0 0 no-repeat;
            }
            .parent1 	{ 
                /* overall animation container */
                height: 0; 
                overflow: hidden;

                -webkit-transition-property: height;
                -webkit-transition-duration: .5s; 
                -webkit-perspective: 1000px; 
                -webkit-transform-style: preserve-3d; 

                -moz-transition-property:height; 
                -moz-transition-duration: .5s; 
                -moz-perspective: 1000px; 
                -moz-transform-style: preserve-3d; 

                -o-transition-property:height; 
                -o-transition-duration: .5s; 
                -o-perspective: 1000px; 
                -o-transform-style: preserve-3d;

                transition-property: height;
                transition-duration: .5s;
                perspective: 1000px;
                transform-style: preserve-3d;
            }
            .parent2	{ 
                /* full content during animation *can* go here */ 
            }
            .parent3	{ 
                /* animated, "folded" block */
                height: 56px; 

                -webkit-transition-property: all; 
                -webkit-transition-duration: .5s;
                -webkit-transform: rotateX(-90deg);
                -webkit-transform-origin: top; 

                -moz-transition-property: all; 
                -moz-transition-duration: .5s;
                -moz-transform: rotateX(-90deg);
                -moz-transform-origin: top; 

                -o-transition-property: all; 
                -o-transition-duration: .5s;
                -o-transform: rotateX(-90deg);
                -o-transform-origin: top;

                transition-property: all; 
                transition-duration: .5s;
                transform: rotateX(-90deg);
                transform-origin: top; 
            }

            /* Hover states to trigger animations */
            #container:hover .parent1	{ height: 111px; }
            #container:hover .parent3	{ 
                -webkit-transform: rotateX(0deg); 
                -moz-transform: rotateX(0deg); 
                -o-transform: rotateX(0deg); 
                transform: rotateX(0deg); 
                height: 111px; 
            }


            /* Static state */
            #text-container 	{ 
                width: 400px; 
                height: 400px; 
                position: relative; 
                border: 1px solid #ccc; 
                background: url(GoogleTestDW.png) 0 0 no-repeat;
            }
            .text-parent1 	{ 
                /* overall animation container */
                height: 0; 
                overflow: hidden;

                -webkit-transition-property: height;
                -webkit-transition-duration: .5s; 
                -webkit-perspective: 1000px; 
                -webkit-transform-style: preserve-3d; 

                -moz-transition-property:height; 
                -moz-transition-duration: .5s; 
                -moz-perspective: 1000px; 
                -moz-transform-style: preserve-3d; 

                -o-transition-property: all; 
                -o-transition-duration: .5s;
                -o-transform: rotateX(-90deg);
                -o-transform-origin: top;

                transition-property: height;
                transition-duration: .5s;
                perspective: 1000px;
                transform-style: preserve-3d;
            }
            .text-parent2	{ 
                /* full content during animation *can* go here */ 
            }
            .text-parent3	{ 
                /* animated, "folded" block */
                height: 56px; 

                -webkit-transition-property: all; 
                -webkit-transition-duration: .5s;
                -webkit-transform: rotateX(-90deg);
                -webkit-transform-origin: top; 

                -moz-transition-property: all; 
                -moz-transition-duration: .5s;
                -moz-transform: rotateX(-90deg);
                -moz-transform-origin: top; 

                -o-transition-property: all; 
                -o-transition-duration: .5s;
                -o-transform: rotateX(-90deg);
                -o-transform-origin: top;

                transition-property: all; 
                transition-duration: .5s;
                transform: rotateX(-90deg);
                transform-origin: top; 
            }

            /* Hover states to trigger animations */
            #text-container:hover .text-parent1	{ height: 111px; }
            #text-container:hover .text-parent3	{ 
                -webkit-transform: rotateX(0deg); 
                -moz-transform: rotateX(0deg); 
                -o-transform: rotateX(0deg); 
                transform: rotateX(0deg); 
                height: 111px; 
            }



            /* Static state */
            #slow-container 	{ width: 400px; height: 400px; position: relative; border: 1px solid #ccc; }
            .slow-parent1 	{ 
                /* overall animation container */
                height: 0; 
                overflow: hidden;

                -webkit-transition-property: height;
                -webkit-transition-duration: .5s; 
                -webkit-perspective: 1000px; 
                -webkit-transform-style: preserve-3d; 

                -moz-transition-property:height; 
                -moz-transition-duration: .5s; 
                -moz-perspective: 1000px; 
                -moz-transform-style: preserve-3d; 

                -o-transition-property: all; 
                -o-transition-duration: .5s;
                -o-transform: rotateX(-90deg);
                -o-transform-origin: top;

                transition-property: height;
                transition-duration: .5s;
                perspective: 1000px;
                transform-style: preserve-3d;

                background: lightgreen;
            }
            .slow-parent2	{ 
                /* full content during animation *can* go here */ 
                background: lightblue;
            }
            .slow-parent3	{ 
                /* animated, "folded" block */
                height: 56px; 
                background: pink;

                -webkit-transition-property: all; 
                -webkit-transition-duration: .5s;
                -webkit-transform: rotateX(-90deg);
                -webkit-transform-origin: top; 

                -moz-transition-property: all; 
                -moz-transition-duration: .5s;
                -moz-transform: rotateX(-90deg);
                -moz-transform-origin: top; 

                -o-transition-property: all; 
                -o-transition-duration: .5s;
                -o-transform: rotateX(-90deg);
                -o-transform-origin: top;

                transition-property: all; 
                transition-duration: .5s;
                transform: rotateX(-90deg);
                transform-origin: top; 
            }

            /* Hover states to trigger animations */
            #slow-container:hover .slow-parent1	{ height: 111px; }
            #slow-container:hover .slow-parent3	{ 
                -webkit-transform: rotateX(0deg); 
                -moz-transform: rotateX(0deg); 
                -o-transform: rotateX(0deg); 
                transform: rotateX(0deg); 
                height: 111px;
            }
        </style>
    </head>
    <body>
        <script>
            var _gaq=[["_setAccount","UA-2087880-2"],["_trackPageview"]];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
                g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
                s.parentNode.insertBefore(g,s)}(document,"script"));
        </script>

        <!-- Add the HTML header -->
        <div id="page">

            <a name="top" id="top"></a>

            <!-- header -->
            <header><div class="centerSite">
                    <!-- top menu: dwb -->
                    <nav role="navigation" class="dwb"><ul>
                            <li class="home"><a href="/" accesskey="h"><span>David Walsh Blog</span></a></li>
                            <li class="articles">
                                <a href="/page/1" accesskey="a">articles</a>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="/page/1">Latest Posts</a></li>
                                        <li><a href="/tutorials/features">Features</a></li>
                                        <li><a href="/tutorials/tips">Quick Tips</a></li>
                                        <li><a href="/s/" rel="nofollow">Script &amp; Style</a></li>
                                        <li class="sep"></li>
                                        <li><a href="/tutorials/html5">HTML5</a></li>
                                        <li><a href="/tutorials/css/animations">CSS Animations</a></li>
                                        <li><a href="/tutorials/jquery">jQuery</a></li>
                                        <li><a href="/tutorials/mootools">MooTools</a></li>
                                        <li><a href="/tutorials/php">PHP</a></li>
                                        <li class="sep"></li>
                                        <li><a href="/post-archive">Post Archives</a></li>
                                        <li><a href="/guest-post">Submit Guest Post</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="demos">
                                <a href="/demos" accesskey="d">demos</a>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="/demos">All Demos</a></li>
                                        <li><a href="/demos/jquery">jQuery Demos</a></li>
                                        <li><a href="/demos/mootools">MooTools Demos</a></li>
                                        <li><a href="/demos/css">CSS Demos</a></li>
                                        <li><a href="/demos/html5">HTML5 Demos</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="connect">
                                <a href="/chat" accesskey="c">connect</a>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="//feeds.feedburner.com/Bludice" rel="nofollow">RSS Feed</a></li>
                                        <li><a href="//twitter.com/davidwalshblog" rel="nofollow">Twitter</a></li>
                                        <li><a href="//facebook.com/davidwalshblog" rel="nofollow">Facebook</a></li>
                                        <li><a href="//plus.google.com/114538814489633467974" rel="nofollow">Google +</a></li>
                                        <li><a href="//linkedin.com/in/davidjameswalsh" rel="nofollow">LinkedIn</a></li>
                                        <li><a href="//alpha.app.net/davidwalsh" rel="nofollow">App.Net</a></li>
                                        <li><a href="//github.com/darkwing" rel="nofollow">GitHub</a></li>
                                        <li><a href="/chat" rel="nofollow">Chat</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="discounts"><a href="/deals">deals</a></li>
                            <li class="about">
                                <a href="/about">david walsh</a>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="/about-david-walsh">About Me</a></li>
                                        <li><a href="/contact">Contact Me</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                        <!-- small logo block, with search, blog title, banner ad, etc. --> 
                        <section class="search"><form action="//google.com/search" id="searchForm">
                                <input type="search" placeholder="Search..." name="q" id="q" accesskey="s" autocomplete="on" required />
                                <input type="hidden" name="sitesearch" value="davidwalsh.name" />
                            </form></section>
                    </nav>

                    <!-- top menu: sns -->
                    <nav role="navigation" class="sns"><ul>
                            <li class="home"><a href="/"><span>David Walsh Blog</span></a></li>
                            <li class="articles"><a href="/s/" rel="nofollow">articles</a>
                                <div class="dropdown">
                                    <ul>
                                        <li><a href="/s/tag/ajax" rel="nofollow">AJAX</a></li>
                                        <li><a href="/s/tag/canvas" rel="nofollow">Canvas</a></li>
                                        <li><a href="/s/tag/css" rel="nofollow">CSS</a></li>
                                        <li><a href="/s/tag/html5" rel="nofollow">HTML5</a></li>
                                        <li><a href="/s/tag/jquery" rel="nofollow">jQuery</a></li>
                                        <li><a href="/s/tag/javascript" rel="nofollow">JavaScript</a></li>
                                        <li><a href="/s/tag/mootools" rel="nofollow">MooTools</a></li>
                                        <li><a href="/s/tag/design" rel="nofollow">Web Design</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="submit"><a href="/s/submit" rel="nofollow">submit</a></li>
                            <li class="customize"><a href="/s/customize" rel="nofollow">customize</a></li>
                        </ul>

                        <!-- small logo block, with search, blog title, banner ad, etc. --> 
                        <section class="search"><form action="/s">
                                <input type="search" placeholder="Search..." name="s" required />
                            </form></section>
                    </nav>

                    <div class="centerSite"><div class="headerTitle">The David Walsh Blog</div></div>
                </div></header>

            <!-- holds content, will be frequently changed -->
            <div id="contentHolder">

                <!-- start the left section if not the homepage -->
                <section class="left">
                    <h1>CSS 3D Folding Animation</h1>
                    <div class="p">Read <a href="http://davidwalsh.name/folding-animation" target="_top">CSS 3D Folding Animation</a></div>
                    <div id="promoNode"></div>	
                    <p>Mouseover the blocks below to see the folding animation!</p>

                    <h3>Simple Map Example</h3>
                    <p>This example shows a map folding down.  The map in this demo is an image, but you could use a real Google Map!</p>
                    <div id="container">
                        <div class="parent1">
                            <div class="parent2">
                                <div class="parent3">
                                    <img src="GoogleTestMap.png" style="opacity: .7;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>&nbsp;</p>
                    <h3>Text over Image</h3>
                    <p>This example shows an elegant way to create an effect that uses opacity over an image.</p>
                    <div id="text-container">
                        <div class="text-parent1">
                            <div class="text-parent2">
                                <div class="text-parent3" style="color: #fff;background: rgba(0, 0, 0, .5)">
                                    <span style="color: #fff; font-size: 24px; display: block; padding: 20px 0 0 20px; 1px 1px 0 rgba(0, 0, 0, 0.25)">David Walsh</span>
                                    <span style="color: #fff; font-size: 16px; display: block; padding: 20px 0 0 100px; 1px 1px 0 rgba(0, 0, 0, 0.25)">is totally epic</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>&nbsp;</p>
                    <h3>Blocks</h3>
                    <p>This example shows colored blocks and a very slow animation to give you a better visual of what's being transformed.</p>
                    <div id="slow-container">
                        <div class="slow-parent1">
                            <div class="slow-parent2">
                                <div class="slow-parent3">
                                    Content
                                </div>
                            </div>
                        </div>
                    </div>







                </section>

                <style>
                    body .one .bsa_it_ad { background: #f8f8f8; border: none; font-family: inherit; width: 200px; position: absolute; top: 0; right: 0; text-align: center; border-radius: 8px; }
                    body .one .bsa_it_ad .bsa_it_i { display: block; padding: 0; float: none; margin: 0 0 5px; }
                    body .one .bsa_it_ad .bsa_it_i img { padding: 10px; border: none; margin: 0 auto; }
                    body .one .bsa_it_ad .bsa_it_t { padding: 6px 0; }
                    body .one .bsa_it_ad .bsa_it_d { padding: 0; font-size: 12px; color: #333; }
                    body .one .bsa_it_p { display: none; }
                    body #bsap_aplink, body #bsap_aplink:hover { display: block; font-size: 10px; margin: 12px 15px 0; text-align: right; }
                </style>
                <!-- BuySellAds Zone Code -->
                <div id="bsap_1280449" class="bsarocks bsap_db3b221ddd8cbba67739ae3837520ffe"></div>
                <!-- End BuySellAds Zone Code -->

                <!-- ads here 
                <div class="demoAds">
                        <div id="bsap_1236348" class="bsarocks bsap_db3b221ddd8cbba67739ae3837520ffe"></div>
                </div>
                -->

            </div>

            <div class="footer"><div class="centerSite">
                    &raquo; Back to: <a href="http://davidwalsh.name/folding-animation" target="_top">CSS 3D Folding Animation</a>
                </div></div>

            <script>
                window.addEventListener("load", function() {
                    var s = "script",
                    d = document,
                    w = window,
                    firstScript = d.getElementsByTagName(s)[0]

                    // BSA bitches!
                    var bsa = d.createElement(s);
                    bsa.async = 1;
                    bsa.src = "//s3.buysellads.com/ac/bsa.js";
                    inject(bsa);

                    // Injects an sync script
                    function inject(s) {
                        firstScript.parentNode.insertBefore(s, firstScript);
                    }

                    // Promo!
                    (function() {

                        var promoNode = d.getElementById("promoNode");

                        // Temporary - use MooTools 2.0 when available
                        function createElement(tagName, attr, parent) {
                            var el = d.createElement(tagName);
                            for(prop in attr) {
                                if(attr.hasOwnProperty(prop)) el.setAttribute(prop, attr[prop]);
                            }
                            parent.appendChild(el);
                            return el;
                        }

                        // Loads a script
                        function loadScript(url) {
                            var script = d.createElement("script");
                            script.src = url;
                            script.setAttribute("async", "true");
                            d.documentElement.firstChild.appendChild(script);
                        }

                        // Create the Twitter widget, inject
                        createElement("a", {
                            href: "//twitter.com/share",
                            "data-count": "horizontal",
                            "class": "twitter-share-button"
                        }, createElement("span", {}, promoNode));
                        loadScript("http://platform.twitter.com/widgets.js");

                        // Create the Google Plus icon
                        var gl = createElement("g:plusone", {
                            href: w.location,
                            size: "medium"
                        }, createElement("span", {}, promoNode));
                        loadScript("//apis.google.com/js/plusone.js");
		
                        // Create the Facebook widget
                        createElement("iframe", {
                            src: "//facebook.com/plugins/like.php?href=" + w.location,
                            scrolling: "no",
                            frameborder: 0,
                            allowTransparency: true,
                            style: "border:none; overflow:hidden; float:left; height:24px; margin-top:3px;"
                        }, createElement("span", {}, promoNode));

                    })();
	
                });
            </script>
    </body>
</html>