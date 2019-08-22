<?php
defined('_DEFVAR') or exit('Restricted Access');
require_once __DIR__.'/../layout/head.php';
?>
<!-- Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-md-9">

            <h4 class="mt-4 listSaved" data-section="code">Code Input</h4>

            <div class="row mt-3 mb-2">

                <div class="col-md-3">
                    <p>
                        <a id="showSaved" class="btn btn-primary" data-toggle="collapse" href="#showSavedTbl" role="button" aria-expanded="false" aria-controls="showSavedTbl">
                            Saved Code
                        </a>
                    </p>

                </div>
                <div class="col-md-9">
                    <form id="loadFileForm" method='post' class="row" enctype="multipart/form-data">
                        <div class="col-12 col-sm pr-sm-0">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="loadFile" name="loadFile">
                                <label class="custom-file-label" for="loadFile">From file</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-auto pl-sm-0">
                            <input type="submit" id="loadFileBtn" value="Insert" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>

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

            <form method='post' class="mt-4" id="codeForm">
                <div class="form-group">
                    <div class="form-check mb-2 mr-sm-2">
                        <input id="asCmd" class="form-check-input" type="checkbox" name="asCmd">
                        <label class="form-check-label" for="asCmd">
                            Run As Command
                        </label>
                    </div>
                    <div id="wrapper">
					<textarea class="form-control darkcode" id="code" name="code" rows="9" autocorrect="off" autocapitalize="off"
                              spellcheck="false"><?php
                        if (isset($_POST['code'])) {
                            echo $_POST['code'];
                        } ?></textarea>
                    </div>
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
                if (isset($_POST['code'])) {

                    try{
                        if(App\Core\Helpers::isShellCmd($_POST['code']) && ENVIRONMENT !== 'local'){
                            echo "No shell commands";
                        } else{
                            if (isset($_POST['asCmd']) && ENVIRONMENT === 'local') {

                                if (App\Core\Helpers::isPhpCmd($_POST['code'])){
                                    echo \App\Core\Helpers::cleanCommand($_POST['code']);
                                } else {
                                    echo "Must be a php command";
                                }

                            } else {
                                echo eval(trim($_POST['code']));
                            }
                        }
                    }catch (Throwable $e){
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


                    <div class="row">
                        <div class="col-md-12">
                            <form method='post' class="row">
                                <div class="col-12 col-sm pr-sm-0">
                                    <input type="text" id="searchTxt" name="searchTxt" placeholder="Search for..." class="form-control">
                                </div>
                                <div class="col-12 col-sm-auto pl-sm-0">
                                    <input type="button" id="searchBtn" value="Search" class="btn btn-primary btn-block">
                                </div>
                            </form>
                        </div>
                    </div>

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