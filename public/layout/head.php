<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My IDE</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <style>
        .linedwrap {
            border: 1px solid #c0c0c0;
            padding: 3px;
        }

        .linedtextarea {
            padding: 0px;
            margin: 0px;
        }

        .linedtextarea textarea, .linedwrap .codelines .lineno {
            font-size: 10pt;
            font-family: monospace;
            line-height: normal !important;
        }

        .linedtextarea textarea {
            padding-right:0.3em;
            padding-top:0.3em;
            border: 0;
        }

        .linedwrap .lines {
            margin-top: 0px;
            width: 50px;
            float: left;
            overflow: hidden;
            border-right: 1px solid #c0c0c0;
            margin-right: 10px;
        }

        .linedwrap .codelines {
            padding-top: 5px;
        }

        .linedwrap .codelines .lineno {
            color:#AAAAAA;
            padding-right: 0.5em;
            padding-top: 0.0em;
            text-align: right;
            white-space: nowrap;
        }

        .linedwrap .codelines .lineselect {
            color: red;
        }
    </style>

    <script async>
        var ENVIRONMENT = '<?php echo getenv('ENV');?>';
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-104186490-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo getenv('GA_CODE');?>');
    </script>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF'],'?page=ide'; ?>">PHP IDE <?php echo phpversion(); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'],'?page=ide'; ?>">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'],'?page=files'; ?>">Files</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'],'?page=db'; ?>">Database</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'],'?page=about'; ?>">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>