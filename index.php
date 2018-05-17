<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Frank+Ruhl+Libre|Great+Vibes" type="text/css">
        <link rel="stylesheet" href="/style/style.css" type="text/css">
    </head>
    <body>
        <nav class="side-nav">
            <ul>
            </ul>
        </nav>
        <header class="section">
            <div class="section-content container">
                <h1>
                    Join us to celebrate the marriage of
                    <span class="big">Lucy and Dave</span>
                    at Balmer Lawn Hotel, Brockenhurst<br />
                    on Saturday, the Twentieth of April, 2019
                </h1>
            </div>
        </header>
        <div class="section balmer">
            <div class="back-cover"></div>
            <div class="section-content container">
                <h2>To Find</h2>
            </div>
        </div>
        <div class="section rsvp">
            <div class="section-content container">
                <h2>To Join <small>Please RSVP by [DATE]</small></h2>
                <?php 
                    $names = $reply = $err = "";
                    $showForm = true;
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $showForm = false;
                        $names = empty($_POST["names"]) ? $err += "Please enter your name<br />" : validate($_POST["names"]);
                        $reply = empty($_POST["rad-rsvp"]) ? $err += "Please let us know if you're coming<br />" : validate($_POST["rad-rsvp"]);
                        
                        if (strlen($err) > 0) {
                            $showForm = true;
                        }
                    }
                    
                    function validate($string) {
                        $string = trim($string);
                        $string = stripslashes($string);
                        $string = htmlspecialchars($string);
                        return $string;
                    }
                
                    if ($showForm) {
                ?>                            
                <div class="errors"><?php echo $err; ?></div>
                <form class="rsvp-form form" id="rsvp-form" action="/" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label id="lblNames" class="control-label" for="txtNames">Names</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txtNames" name="names" class="form-control textbox" />    
                            <div class="textbox-line"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-1 col-sm-10">
                            <div class="radio">
                                <input type="radio" id="radYes" name="rad-rsvp" />
                                <label id="lblRadYes" class="control-label" for="radYes">I/We will be there!</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="radNo" name="rad-rsvp" />
                                <label id="lblRadNo" class="control-label" for="radNo">Sorry, I/We can't make it.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-4 col-sm-4">
                            <input type="submit" id="btnRSVP" class="btn btn-default btn-rsvp" value="RSVP" /> 
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                <div class="thanks">
                    <h3>Thanks for RSVPing!</h3>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="section meal">
            <div class="back-cover"></div>
            <div class="section-content container">
                <h2>To Eat</h2>
            </div>
        </div>

        <script
          src="https://code.jquery.com/jquery-1.12.4.min.js"
          integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
          crossorigin="anonymous"></script>
        <script>
            var currNav = 0;
        
            $(function() {
                var sections = $(".section");
                var nav = $(".side-nav ul");
                for (var s = 1; s <= sections.length; s++) {
                    nav.append("<li />");
                }
                nav.find("li").first().addClass("active");
            });
        
            $(window).on("load", function() {
                $("header").addClass("animate");
            });
            
            $(window).on("mousewheel", function(event) { 
                parseScroll(event, null);
                return false;
            });
            
            $(window).on("keyup", function(event) {
                if (event.keycode == 38|| event.which == 38)
                    parseScroll(event, "up");
                if (event.keycode == 40|| event.which == 40)
                    parseScroll(event, "down");
                return false;
            });
            
            function parseScroll(event, direction) {
                var body = $("body");
                var $top = body.css("top");
                var $height = body.outerHeight();
                var totalHeight = 0;
                
                $top = parseInt($top);
                
                $(".section").each(function() {
                    totalHeight += $(this).outerHeight();
                });
                
                if (direction == null) {
                    if (event.originalEvent.wheelDelta > 0)
                        direction = "up";
                    else
                        direction = "down";
                }    
                
                if (!body.hasClass("scroll")) {
                    body.addClass("scroll");
                    
                    var navs = $(".side-nav ul li");
                    
                    navs.removeClass("active");
                    
                    if (direction == "up") {
                        if ($top != 0) {                        
                            console.log("scroll Up");
                            body.animate({
                                top: $top + $height
                            },1000);
                            currNav--;
                        }
                    } else if (direction == "down") {
                        if ($top != -(totalHeight - $height)) {  
                            console.log("scroll Down");
                            body.animate({
                                top: $top - $height
                            },1000);
                            currNav++;
                        }
                    } else {}
                    navs.eq(currNav).addClass("active");
                    setTimeout(function(){
                        body.removeClass("scroll");
                    },2000);
                }
            }
        </script>
    </body>
</html>