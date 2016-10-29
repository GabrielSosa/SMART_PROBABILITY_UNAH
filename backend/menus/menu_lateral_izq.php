<!-- Sidebar -->

<?php
if (isset($_SESSION['online'])) {
    echo '
            <div id="sidebar-envolt">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <center><span class="label label-default">Menú</span></center>
                    </li>
                    <li>
                        <a href="sondeo_clases.php">Sondeo De Clases</a>
                    </li>
                </ul>
            </div> <!-- End sidebar-envolt -->
        ';
    }
?>