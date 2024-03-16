<footer class="site-footer container p-0 bg-white" id="colophon">
    <div class="footer-sidebar container p-md-0">
        <div class="row py-4 mx-0">
            <?php
            for ($x = 1; $x <= 4; $x++) :
                if (is_active_sidebar('footer-widget-' . $x)) {
                    echo '<div class="col-md-3">';
                    dynamic_sidebar('footer-widget-' . $x);
                    echo '</div>';
                }
            endfor;
            ?>
        </div>
    </div>

    <div class="site-info border-top text-center py-3">
        <small>
            © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
            <br>
            Design by <a class="opacity-50" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->

</footer>