<?php
defined('_DEFVAR') or exit('Restricted Access');
require_once __DIR__.'/../layout/head.php';
?>
<!-- Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-md-9">

            <h4 class="mt-4 listSaved" data-section="file">Files</h4>

            <p>
                <a id="showSaved" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Saved Code
                </a>
            </p>
            <div class="collapse" id="collapseExample">

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
                        <?php foreach ($vars['sections']['files'] as $k => $v): ?>
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
                    if (isset($_POST['asCmd'])) {
                        echo '<pre>', system(trim($_POST['code'])), '</pre>';
                    } else {
                        echo eval(trim($_POST['code']));
                    }
                } else {
                    echo '<p>code output will be here</p>';
                }
                ?>
            </div>


        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-3">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">New File</h5>
                <div class="card-body">

                    <form method='post' class="form-inline">
                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                        <input id="newFile" name="newFile" type="text" class="form-control"
                               placeholder="File name...">

                        <button id="newFileBtn" type="button" class="btn btn-primary">Create</button>
                    </form>

                </div>
            </div>

            <!-- files Widget -->
            <div class="card my-4">
                <h5 class="card-header">Directory List</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul id="fileUlList" class="list-unstyled mb-0">
                                <!-- generated in files.js -->
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