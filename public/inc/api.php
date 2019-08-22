<?php
defined('_DEFVAR') or exit('Restricted Access');
require_once __DIR__.'/../layout/head.php';
?>
<!-- Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-md-9">

            <h4 class="mt-4 listSaved" data-section="code">API Client</h4>

            <p>
                <a id="showSaved" class="btn btn-primary" data-toggle="collapse" href="#showSavedTbl" role="button" aria-expanded="false" aria-controls="showSavedTbl">
                    Saved Code
                </a>
            </p>
            <div class="collapse" id="showSavedTbl">

                <table class="table">
                    <thead>
                    <tr>
                        <th class="w-75" scope="col">Title</th>
                        <th class="w-auto" scope="col">Section</th>
                        <th class="w-auto" scope="col">Saved</th>
                        <th class="w-auto" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="saved_code">

                    </tbody>
                </table>


            </div>

            <div id="searchResult" class="alert alert-secondary overflow-auto" role="alert">

            </div>

            <form method='post' class="mt-4" id="apiForm">
                <div class="form-group">
                    <div class="form-check mb-2 mr-sm-2">
                        <input id="asCmd" class="form-check-input" type="checkbox" name="asCmd">
                        <label class="form-check-label" for="asCmd">
                            Run As Command
                        </label>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" id="uri" name="uri" placeholder="Enter URI"
                            value="<?php
                            if (isset($_POST['uri'])) {
                                echo $_POST['uri'];
                            } ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <select name="request_method" class="form-control">
                                <option selected value="POST">Post</option>
                                <option value="GET">Get</option>
                            </select>
                        </div>
                    </div>
                    <textarea class="form-control darkcode" id="postData" name="postData" rows="5" autocorrect="off" autocapitalize="off"
                              spellcheck="false" placeholder="Post Data"><?php
                        if (isset($_POST['postData'])) {
                            echo $_POST['postData'];
                        } ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">Run</button>
                    |
                    <button id="resetBtn" type="reset" class="btn btn-primary mb-2">Clear</button>
                    |
                    <button id="saveBtn" type="button" class="btn btn-primary mb-2">Save</button>
                </div>

            </form>

            <hr/>
            <form method='post' class="mt-4" id="codeSaveForm">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Title</label>
                    <input id="codeSaveTitle" name="code_title" type="text" class="form-control"
                           id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <select id="code_section" name="code_section" class="form-control narrowSelect">
                        <?php foreach ($vars['sections']['code'] as $k => $v): ?>
                            <option value="<?php echo $v; ?>"><?php echo ucfirst($v); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button id="codeSaveBtn" type="button" class="btn btn-primary mb-2">Save</button>
                </div>

            </form>

            <div class="code-display alert alert-secondary overflow-auto mb-5" role="alert">
                <?php
                if (isset($_POST['uri'])) {
                    try {
                        echo '<pre>',var_dump(\App\Core\Api::processPost($_POST['uri'], $_POST['postData']));
                    } catch (Throwable $e) {
                        echo $e->getMessage();
                    }
                } else {
                    echo $vars['output'];
                }
                ?>
            </div>


        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-3">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">


                    <form method='post' class="form-inline">
                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                        <input id="searchTxt" name="searchTxt" type="text" class="form-control"
                               placeholder="Search for...">

                        <button id="searchBtn" type="button" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Output & Arrays</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a id="numArray" href="#">Indexed</a>
                                </li>
                                <li>
                                    <a id="numArrayAssoc" href="#">Associative</a>
                                </li>
                                <li>
                                    <a id="numArrayMulti" href="#">Multi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a id="preTags" href="#">pre tags</a>
                                </li>
                                <li>
                                    <a id="printr" href="#">printr</a>
                                </li>
                                <li>
                                    <a id="breakTag" href="#">Break Tag</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12 mt-2">

                            <form class="form-inline">
                                <div class="form-group">
                                    <select class="form-control" id="codeSelect">
                                        <option value="" selected>String Funcs</option>
                                        <?php foreach ($vars['str_funcs'] as $k => $v): ?>
                                            <option><?php echo $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Class & Objects</h5>
                <div class="card-body">
                    <div class="row" id="strList">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a id="phpClass" href="#">Class</a>
                                </li>
                                <li>
                                    <a id="phpInterface" href="#">Interface</a>
                                </li>
                                <li>
                                    <a id="phpObj" href="#">STD Object</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a id="phpClass2" href="#">PHP Class</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
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