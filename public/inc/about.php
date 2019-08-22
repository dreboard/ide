<?php
defined('_DEFVAR') or exit('Restricted Access');
require_once __DIR__.'/../layout/head.php';
?>
<!-- Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-md-9 mt-3">

            <h3>About PHP IDE</h3>
            <div class="mt-3">
                <ul class="about-description">
                    <li>Write PHP Online is an online code editor which helps you to write and test run/execute your php code online from your browser. This is one of the simple and powerfull online php code editor tool available on the internet.</li>
                    <li>Write PHP Online supports all PHP functionality's and it runs using PHP version <?php echo phpversion(); ?>. If you want us to provide more PHP versions then please send us your thoughts on this.</li>
                    <li>We have disabled some of potentially unwanted PHP powered shell functions executing from this site for security reasons.</li>
                    <li>We do not track your IP address or save any cookies, also we do not save any information about the code you run and your personal details.</li>
                    <li>Thank you for using this tool, keep visiting and happy coding.</li>
                </ul>
            </div>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-3">

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Features</h5>
                <div class="card-body">
                    <div class="row" id="strList">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>Class
                                </li>
                                <li>Interface
                                </li>
                                <li>STD Object
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>Strings
                                </li>
                                <li>Arrays</li>
                                <li>Files</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php require_once __DIR__.'/../layout/footer.php'; ?>