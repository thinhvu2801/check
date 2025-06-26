<footer class="main-footer text-sm">
    &nbsp;
    <div class="float-right d-none d-sm-inline-block">
        <strong>Copyright &copy; 2014-{$current_year} <a href="http://mentautomation.com">MenT Automation</a>.</strong>
        All rights reserved.
    </div>
</footer>
<script>
var elem = document.documentElement;
$("#exitfullscreen").hide();
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
    }
    $("#exitfullscreen").show();
    $("#fullscreen").hide();
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
    $("#fullscreen").show();
    $("#exitfullscreen").hide();
}
</script>