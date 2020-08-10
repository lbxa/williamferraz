<!--
 ___       __   ___  ___       ___       ___  ________  _____ ______           ________ _______   ________  ________  ________  ________
|\  \     |\  \|\  \|\  \     |\  \     |\  \|\   __  \|\   _ \  _   \        |\  _____\\  ___ \ |\   __  \|\   __  \|\   __  \|\_____  \
\ \  \    \ \  \ \  \ \  \    \ \  \    \ \  \ \  \|\  \ \  \\\__\ \  \       \ \  \__/\ \   __/|\ \  \|\  \ \  \|\  \ \  \|\  \\|___/  /|
 \ \  \  __\ \  \ \  \ \  \    \ \  \    \ \  \ \   __  \ \  \\|__| \  \       \ \   __\\ \  \_|/_\ \   _  _\ \   _  _\ \   __  \   /  / /
  \ \  \|\__\_\  \ \  \ \  \____\ \  \____\ \  \ \  \ \  \ \  \    \ \  \       \ \  \_| \ \  \_|\ \ \  \\  \\ \  \\  \\ \  \ \  \ /  /_/__
   \ \____________\ \__\ \_______\ \_______\ \__\ \__\ \__\ \__\    \ \__\       \ \__\   \ \_______\ \__\\ _\\ \__\\ _\\ \__\ \__\\________\
    \|____________|\|__|\|_______|\|_______|\|__|\|__|\|__|\|__|     \|__|        \|__|    \|_______|\|__|\|__|\|__|\|__|\|__|\|__|\|_______|
 -->
<!DOCTYPE html>                  <!-- williamferraz.com Mark 1 -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<?php
    $page_title = "William Ferraz ";
    $page_location = "Photography";
    $page_description = "williamferraz.com is currently under construction.";
    $page_keywords = 'construction, website, william, ferraz';
    $page_display_title = $page_title . " | " . $page_location;
    require_once('inc/head.php');
?>
<body>
<style media="screen">
    * {
        margin: 0; padding: 0;
    }

    html {
        min-width: 1000px !important;
    }

    .splash-screen {
        display: flex !important;
        width: 100vw !important; height: 100vh !important;
        justify-content: center !important;
        align-items: center;
        background-image: -webkit-linear-gradient(45deg ,#f35626, #feab3a);
        -webkit-animation: hue 20s infinite linear;
        -moz-animation:    hue 20s infinite linear;
        -ms-animation:     hue 20s infinite linear;
        -o-animation:      hue 20s infinite linear;
        animation:         hue 20s infinite linear;
    }

    -webkit-@keyframes hue {
        from {-webkit-filter: hue-rotate(0deg);}
        to {-webkit-filter: hue-rotate(-360deg);}
    }

    -moz-@keyframes hue {
        from {-webkit-filter: hue-rotate(0deg);}
        to {-webkit-filter: hue-rotate(-360deg);}
    }

    -ms-@keyframes hue {
        from {-webkit-filter: hue-rotate(0deg);}
        to {-webkit-filter: hue-rotate(-360deg);}
    }

    -o-@keyframes hue {
        from {-webkit-filter: hue-rotate(0deg);}
        to {-webkit-filter: hue-rotate(-360deg);}
    }

    @keyframes hue {
        from {-webkit-filter: hue-rotate(0deg);}
        to {-webkit-filter: hue-rotate(-360deg);}
    }

    -webkit-@keyframes fade_in_down {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: none;
        }
    }

    -moz-@keyframes fade_in_down {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: none;
        }
    }

    -ms-@keyframes fade_in_down {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: none;
        }
    }

    -o-@keyframes fade_in_down {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes fade_in_down {
        from {
            opacity: 0;
            transform: translate3d(0, -100%, 0);
        }
        to {
            opacity: 1;
            transform: none;
        }
    }

    .splash-logo {
        display: block;
        width: 30%; height: auto;
        margin: auto;
        margin-right: 20px;
        -webkit-animation-name: fade_in_down;
        -moz-animation-name:    fade_in_down;
        -ms-animation-name:     fade_in_down;
        -o-animation-name:      fade_in_down;
        animation-name:         fade_in_down;
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    #timer {
        margin: auto;
        font-size: 2.5rem;
        margin-left: 20px;
    }

    #timer > span {
        display: inline-block;
        width: auto; height: auto;
        min-width: 130px;
        background-color: rgba(255, 255, 255, 0.3);
        padding: 5px 10px;
        border-radius: 10px;
    }

    .timer-label {
        font-size: 1rem;
        padding-left: 0.25rem;
    }

    .splash-msg {
        position: fixed;
        bottom: 0; left: 0; right: 0;
        display: block;
        width: 100%;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .splash-msg > span {
        position: fixed;
        bottom: 0; left: 50%;
        line-height: 60px;
        transform: translateX(-50%);
        font-size: 1.5rem;
    }
</style>

<div class="splash-screen">
    <img src="logo/WFerraz_logo_Tranparency.png" alt="WF Logo" class="splash-logo">
    <div id="timer">
        <span id="timer-days"></span>
        <span id="timer-hours"></span>
        <span id="timer-mins"></span>
        <span id="timer-secs"></span>
    </div>
    <div class="splash-msg">
        <span><i class="fal fa-exclamation-triangle"></i>&nbsp;&nbsp;Website Under Construction</span>
    </div>
</div>

</body>
<script type="text/javascript">
    // refer to @https://www.developerdrive.com/2019/02/build-countdown-timer-pure-javascript/ for code

    const endDate = new Date("Jun 7, 2019 12:00:00").getTime();

    let timer = setInterval(function() {
        let now = new Date().getTime();
        let remainingTime = endDate - now;

        if (remainingTime >= 0) {
            let days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            let hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let mins = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            let secs = Math.floor((remainingTime % (1000 * 60)) / 1000);

            document.getElementById("timer-days").innerHTML = days +
            "<span class='timer-label'>DAY(S)</span>";

            document.getElementById("timer-hours").innerHTML = ("0"+hours).slice(-2) +
            "<span class='timer-label'>HR(S)</span>";

            document.getElementById("timer-mins").innerHTML = ("0"+mins).slice(-2) +
            "<span class='timer-label'>MIN(S)</span>";

            document.getElementById("timer-secs").innerHTML = ("0"+secs).slice(-2) +
            "<span class='timer-label'>SEC(S)</span>";
        }
    }, 1000);

</script>
</html>
