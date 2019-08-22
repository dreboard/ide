$(document).ready(function () {

    (function(){
        getAllFiles();
    }());
    var codeBlock = document.getElementById('code');
    var codeBlock = document.getElementById('code');

    function load_txt() {
        $(codeBlock).val('').empty();
        var loadxml =
            `if (file_exists('files/file.txt')) {
$homepage = file_get_contents('files/file.txt');
echo $homepage;
}`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadxml);
        }
    }

    function load_html() {
        $(codeBlock).val('').empty();
        var loadxml =
            `if (file_exists('files/file.html')) {
$homepage = file_get_contents('files/file.html');
echo $homepage;
}`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadxml);
        }
    }

    function load_csv() {
        $(codeBlock).val('').empty();
        var loadxml =
            `if (file_exists('files/file.csv')) {
$row = 1;
if (($handle = fopen("files/file.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\\n";
        }
    }
    fclose($handle);
}
}`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadxml);
        }
    }
    function load_xml() {
        $(codeBlock).val('').empty();
        var loadxml =
            `if (file_exists('files/file.xml')) {
    $xml = simplexml_load_file('files/file.xml');
    echo "<pre>"; print_r($xml);
}`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadxml);
        }
    }

    $("#newFileBtn").on("click", function (event) {
        try{
            event.preventDefault();
            getAllFiles();
            var post_url = 'requests/file.php';
            var request_method = 'post';
            $.ajax({
                url: post_url,
                type: request_method,
                data: {newFile: $('#newFile').val()},
            }).done(function (response) { //
                console.log(response);
                event.stopImmediatePropagation();
                //$("#server-results").html(response);
            }).fail(function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + error);
            });
        }catch(error) {
            console.log(error);
        }

    });

    $("#loadFileForm").on("submit", function (event) {
        try{
            event.preventDefault();
            var post_url = 'requests/file.php';
            var data = new FormData(this);
            $.ajax({
                url: post_url,
                type: 'POST',
                contentType: false,
                cache: false,
                processData:false,
                data: new FormData(this)
            }).done(function (response) {
                console.log(response);

                if (codeBlock.setRangeText) {
                    codeBlock.setRangeText(response);
                }

            }).fail(function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + error);
            });
        }catch(error) {
            console.log(error);
        }

    });


    function fileTypeLoader(type){
        switch(type) {
            case 'xml':
                load_xml();
                break;
            case 'txt':
                load_txt();
                break;
            case 'csv':
                load_csv();
                break;
            default:
                load_html();
        }
    }


    function getAllFiles(){
        try{
            var post_url = 'requests/file.php?get_all=all';
            var request_method = 'GET';
            $.ajax({
                url: post_url,
                type: request_method,
            }).done(function (response) { //
                response = $.parseJSON(response);
                //console.log(response);
                //if (!$.isArray(response)) response = [response];
                $('#fileUlList').empty();
                $.each(response.files, function (index, value) {

                    //console.dir(value);
                    ulHTML = '<li class="new_file_row"><a href="#" class="file_link" data-file_ext="'+ value.extension +'" data-file_url="'+ value.basename +'">' + value.basename + '</a></li>';

                    $('#fileUlList').append(ulHTML);


                    $('a.file_link').each(function (value) {
                        var code_id = $(this).data('file_url');

                        $(this).off('click').on("click", function (evt) {
                            evt.preventDefault();
                            var load_code = $(this).data('file_ext');

                            fileTypeLoader(load_code);

                            var post_url = 'requests/file.php';
                            var request_method = 'post';
                            $.ajax({
                                url: post_url,
                                dataType: 'json',
                                type: request_method,
                                data: {loadFile: $(this).data('file_url')},
                            }).done(function (response_code,status,jqXHR) {
                                var responseXML = $.parseXML(response_code.code);
                                //console.log(responseXML);
                                //console.log(response_code.code);
                                //$('.code-display').append('<pre> <?php echo eval(trim('+response_code.code+'))</pre>>');

                            }).fail(function (jqXHR, textStatus) {
                                ///var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + textStatus );
                            });
                        });
                    }); // end file_link
                });


            });
        }catch(error) {
            console.log(error);
        }

    }



});
