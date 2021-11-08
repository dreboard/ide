/*! Code IDE - v0.0.1 - 2019
* https://github.com/dreboard
* Copyright (c) 2019 Dre Board; Licensed MIT */

$(document).ready(function () {
    if(document.getElementById('code')){
        var codeBlock = document.getElementById('code');
    } else {
        var code = '';
    }

    if(document.getElementById('codeForm')){
        var codeForm = document.getElementById('codeForm');
    } else {
        var codeForm = '';
    }
    var asCmd = document.getElementById('asCmd');
	var numsArray = "$nums = [1 ,2, 3];";
	var preTag = "echo '<pre>'; echo '</pre>';";
	var printRTag = "print_r();";
	var breakTag = "echo '<br />';";

	var phpObj = `$obj = new stdClass();
$obj->one = 1;
$obj->two = 2;
$obj->three = 3;
echo '<pre>'; print_r($obj); echo '</pre>';`;

    $("#codeSaveForm").hide();
    var numArrayAssoc = "$nums = ['one' =>1, 'two' => 2, 'three' => 3];";
    var numArrayMulti = "$nums = ['one' => ['first', 'one'], 2 =>  ['second', 'two'], 3=>  ['third', 'three']];";

    var phpClass =
        `class MyClass { 
    protected $nums = [];
	
    public function __construct(){
        //
    }
}
$obj = new MyClass();
$obj->one = 1;
$obj->two = 2;
$obj->three = 3;
echo '<pre>'; print_r($obj); echo '</pre>';

`;
    var phpInterface = 'interface MyInterface {}';

    $(code).on('keydown', function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode === 9) {
            e.preventDefault();
            var start = this.selectionStart;
            var end = this.selectionEnd;
            var val = this.value;
            var selected = val.substring(start, end);
            var re = /^/gm;
            var count = selected.match(re).length;
            this.value = val.substring(0, start) + selected.replace(re, '\t') + val.substring(end);
            this.selectionStart = start;
            this.selectionEnd = end + count;
        }
    });

    function insertText(elemID, text) {
        var elem = document.getElementById(elemID);
        elem.innerHTML += text;
    }

    $("#preTags").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(preTag);
        }
        //codeBlock.innerHTML += preTag;
    });
    $("#breakTag").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(breakTag);
        }
        //codeBlock.innerHTML += preTag;
    });
    $("#numArray").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(numsArray);
        }
        //codeBlock.innerHTML += numsArray;
    });

    $("#numArrayAssoc").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(numArrayAssoc);
        }
        //codeBlock.innerHTML += numsArray;
    });

    $("#numArrayMulti").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(numArrayMulti);
        }
        //codeBlock.innerHTML += numsArray;
    });



    $("#printr").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(printRTag);
        }
    });
    $("#phpClass").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(phpClass);
        }
    });

    $("#phpInterface").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(phpInterface);
        }
    });
    $("#phpObj").on("click", function (e) {
        e.preventDefault();
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(phpObj);
        }
    });

    $("#saveBtn2").on("click", function (event) {
        var post_url = 'requests/form.php';
        var request_method = 'post';
        $.ajax({
            url: post_url,
            type: request_method,
            data: {code: $('#code').val()},
        }).done(function (response) { //
            console.log(response);
            event.stopImmediatePropagation();
            //$("#server-results").html(response);
        });
    });

    $("#searchBtn").on("click", function (event) {
        event.preventDefault();
        var post_url = 'requests/search.php';
        var request_method = 'post';
        $.ajax({
            url: post_url,
            type: request_method,
            data: {searchTxt: $("#searchTxt").val()},
        }).done(function (response) { //

            $("#searchResult").html(response);
            event.stopImmediatePropagation();
        });
    });


    $("#saveBtn").on("click", function (event) {
        $("#codeSaveForm").show();
        $("#codeSaveTextarea").val($('#code').val());
    });

    $("#code, #codeSaveTitle").on("focus", function (event) {
        $(this).removeClass('is-invalid');
    });

    $("#codeSaveBtn").on("click", function (event) {

        if($('#code').val() === ""){
            $('#code').addClass('is-invalid');
            return false;
        }
        if($("#codeSaveTitle").val() === ""){
            $("#codeSaveTitle").addClass('is-invalid');
            return false;
        }
        event.preventDefault();
        var post_url = 'requests/save.php';
        var request_method = 'post';

        $.ajax({
            url: post_url,
            type: request_method,
            data: {
                code_title: $("#codeSaveTitle").val(),
                code_block: $('#code').val(),
                code_section: $('#code_section').val()
            },
        }).done(function (response) { //
            $("#searchResult").html(response);
            $("#codeSaveForm").hide();
            $("#codeSaveTitle").val('');
            event.stopImmediatePropagation();
        }).fail(function (response, xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText;
            console.log('Error - ' + errorMessage);
        });
	}); // end codeSaveBtn

    $("#resetBtn").on("click", function (event) {

        try {
            if ($("#codeForm").length) {
                $("#codeForm").get(0).reset();
                $('#code').val('').empty();
                document.getElementById('code').innerHTML = "";
            }

            if ($("#apiForm").length) {
                $("#apiForm").get(0).reset();
                $('#apiForm #uri').val('').empty();
                $(' #postData').val('').empty();
            }
        }
        catch(error) {
            //console.error(error);
            console.log(error);
        }

    }); // end resetBtn


    $("#showSaved").on("click", getAllCodeBlocks());

    function getAllCodeBlocks(){
        var section = $( ".listSaved" ).data( "section" );
        $('#saved_code').empty();
        var post_url = 'requests/code.php?get_all='+section+'';
        var request_method = 'GET';
        $.ajax({
            url: post_url,
            type: request_method,
        }).done(function (response) {
            //console.log(response);
            //response = $.parseJSON(response);
            $.each(JSON.parse(response), function (index, value) {
                trHTML = '<tr class="new_code_row"><th><a href="#" class="code_link" data-code_id="'+ value.id +'"> ' + value.code_title + '</a></th><td>' + value.code_section + '</td><td>' + value.code_date + '</td><td><button class="btn btn-danger code_delete_btn" data-code_id="'+ value.id +'" type="button">X</button></td></tr>';
                $('#saved_code').append(trHTML);
                //console.log(value.id);

                $('.code_link').each(function (value) {

                    $(this).off('click').on("click", function (evt) {
                        var post_code_id = $(this).data('code_id');
                        console.log('id IS ' + post_code_id);
                        evt.preventDefault();
                        evt.stopImmediatePropagation();
                        $.ajax({
                            url: 'requests/code.php/var/www/code',
                            method:"POST",
                            data: {code_id: post_code_id},
                        }).done(function (response_code) {

                            console.log(response_code);
                            try {
                                console.log(response_code.code_block);

                                $('#code').append(response_code);
                                if(response_code.code_section === 'command'){
                                    $(asCmd).prop('checked', true);
                                }
                            } catch (e) {
                                console.log(e);
                            }

                        }).fail(function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            console.log('Error - ' + error);
                        });
                    });
                }); // end .code_link

                $('.code_delete_btn').each(function () {
                    $(this).on("click", function (e) {
                        e.stopImmediatePropagation();
                        console.log($(this).data('code_id'));
                        var code_id = $(this).data('code_id');
                        var post_url = 'requests/code.php';
                        var request_method = 'post';
                        $.ajax({
                            url: post_url,
                            type: request_method,
                            data: {delete_id: $(this).data('code_id')},
                        }).done(function (response) {
                            getAllCodeBlocks();
                            $("#searchResult").html(response);
                        }).fail(function (xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            console.log('Error - ' + error);
                        });
                    });
                });  // end .code_delete_btn


            });


        });
    }

    function clearCode(){
        $('#code').val('').empty();
        document.getElementById("code").innerHTML = "";
        $("#codeForm").get(0).reset();
    }

    function logMessage(msg){
        if(ENVIRONMENT === 'local'){
           console.log(ENVIRONMENT+': '+msg);
        }
    }
});
