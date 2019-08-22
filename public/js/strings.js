$(document).ready(function () {

    var codeBlock = document.getElementById('code');
    var codeSelect = document.getElementById('codeSelect');

    $(codeSelect).change(function() {
        func = 'load_' + $("#codeSelect :selected").text();
        var method = eval('(' + func + ')');
        method();
    });

    function load_explode() {
        //// $(codeBlock).val('').empty();
        var loadCode =
            `// Returns an array of strings
$str = "Hello World!";
$str_array = explode(" ", $str);
print "<pre>";
print_r($str_array);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_implode() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Join array elements with a string.
$array = array("Hello", "World!");
$str = implode(",", $array);
echo $str;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strip_tags() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Strip HTML and PHP tags from a string.
$str = "<html><body><b>Hello</b> World!</body></html>";
echo $str;
echo "<br>";
echo strip_tags($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }


    function load_htmlentities() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Convert all applicable characters to HTML entities.
$str = "Hello <b>World</b>!";
echo htmlentities($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_html_entity_decode() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Convert all HTML entities to their applicable characters.
$str = "Hello <b>World</b>";
$a = htmlentities($str);
$b = html_entity_decode($a);
echo $a;
echo "<br>";
echo $b;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_htmlspecialchars() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Convert special characters to HTML entities.
echo "<a href='#'>Hello</a> World!";
echo "<br>";
$new = htmlspecialchars("<a href='test'>Hello</a> World!", ENT_QUOTES);
echo $new;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_htmlspecialchars_decode() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Convert special HTML entities back to characters.
$str = "Hello -&gt; &amp; World!";
echo htmlspecialchars_decode($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strtolower() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Make a string lowercase.
$str = "HELLO WORLD!";
echo strtolower($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strtoupper() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Make a string uppercase.
$str = "Hello World!";
echo strtoupper($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_str_replace() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Replace all occurrences of the search string with the replacement string.
$str = str_replace("World", "Universe", "Hello World!");
echo $str;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_lcfirst() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "HELLO WORLD!";
echo lcfirst($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_ucfirst() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "HELLO WORLD!";
echo ucfirst($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_ucwords() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "lets hello to the world!";
echo ucwords($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_wordwrap() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "Lets hello to the wonderful world!";
echo wordwrap($str, 20, "<br/>");`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strlen() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "Hello World!";
echo strlen($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_trim() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = " Hello World! ";
echo trim($str);
echo "<br>";
echo trim($str, " H");
echo "<br>";
echo trim($str, "ld! ");
echo "<br>";`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_ltrim() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str  = "  Hello World";
$str1 = ltrim($str);
echo $str1;
echo "<br>";
echo ltrim($str1, "Hell");`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_rtrim() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str  = "Hello World!  ";
$str1 = rtrim($str);
echo $str1;
echo "<br>";
echo rtrim($str1, "rld!");`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_print() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `print("Hello World");
print "<br/>";
print "Hello World!";`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_printf() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `printf("Lets just say %s %s", "Hello", "World!");`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_substr() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `echo substr("abcdef", 1);
echo substr("abcdef", 1, 3);
echo substr("abcdef", 0, 4);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strstr() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "Hello#World";
echo strstr($str, "#");
echo '<br>';
echo strstr($str, "#", true);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_strcmp() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str1 = "Hello";
$str2 = "hello";
if (strcmp($str1, $str2) !== 0) {
    echo "'$str1' is not equal to '$str2' because this is case sensitive string comparison function.";
}`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_str_pad() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `echo str_pad(1, 4, "0", STR_PAD_LEFT);
echo "<br>";
echo str_pad(10, 4, "0", STR_PAD_LEFT);
echo "<br>";
echo str_pad(100, 4, "0", STR_PAD_LEFT);
echo "<br>";
echo str_pad(1000, 4, "0", STR_PAD_LEFT);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_str_split() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "Hello World!";
print "<pre>";
print_r(str_split($str));
print "</pre>";`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_str_repeat() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `echo str_repeat("blah ", 10);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_str_shuffle() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = "Hello World!";
echo str_shuffle($str);`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }


    function load_md5() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `$str = md5("password12345");
$str2 = md5("password12345", true);            
echo $str;
echo "<br>";
echo $str;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }

    function load_similar_text() {
        // $(codeBlock).val('').empty();
        var loadCode =
            `// Returns the number of matching chars in both strings.
$str1 = "Hello"; 
$str2 = "Hell No!"; 
similar_text($str1, $str2, $percent);
echo $percent;`;
        if (codeBlock.setRangeText) {
            codeBlock.setRangeText(loadCode);
        }
    }



});
