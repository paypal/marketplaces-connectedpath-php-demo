<?php
$mode = (isset($_REQUEST["mode"]) &&  $_REQUEST["mode"] == "isu") ? "isu" : "ma";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <title>PayPal Demo</title>

    <!--Including Bootstrap style files -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <style>
        tr {
            line-height: 30px;
        }
        td {
            padding: 5px;
        }

        .mark {
            height: 40px;
        }

        .colCentered {
            float: none;
            margin: 0 auto;
        }

        /*
            Rounded gray section borders
        */
        .divBorder {
            margin-top:10px;
            border: #cccccc medium solid;
            border-radius: 10px;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        /*
            Ajax Spinner
        */
        .loader {
            border: 4px solid #d0d0d0; /* Light grey */
            border-top: 4px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 28px;
            height: 28px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


        /*
            Top gradient strip
        */
        .bg-color {
            color: white;
            background: -moz-linear-gradient(0deg, #004094 0%, #0096D9 50%, #004094 100%); /* ff3.6+ */
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, #004094), color-stop(50%, #0096D9), color-stop(100%, #004094)); /* safari4+,chrome */
            background: -webkit-linear-gradient(0deg, #004094 0%, #0096D9 50%, #004094 100%); /* safari5.1+,chrome10+ */
            background: -o-linear-gradient(0deg, #004094 0%, #0096D9 50%, #004094 100%); /* opera 11.10+ */
            background: -ms-linear-gradient(0deg, #004094 0%, #0096D9 50%, #004094 100%); /* ie10+ */
            background: linear-gradient(90deg, #004094 0%, #0096D9 50%, #004094 100%); /* w3c */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#004094', endColorstr='#004094',GradientType=1 ); /* ie6-9 */
        }

        /*
            White hyperlink
        */
        a.light-links, a.light-links:hover, a.light-links:active, a.light-links:visited {
            color: white;
            text-decoration: underline;
        }

        /*
            Styles for the Overview images
        */
        .outer-border {
            margin: 10px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            min-height: 124px;
            width: 140px;
            text-align: center;
            padding-top: 6px;
        }

        .border-highlight {
            border: 4px solid #ff9999;
        }

        .border-default {
            border: 4px solid #a6e4ff;
        }

        .border-grayout {
            border: 4px solid #cccccc;
        }

        .grayout {
            opacity: 0.4;
            filter: alpha(opacity=40);
        }

        .hand-pointer {
            cursor: pointer;
            cursor: hand;
        }


    </style>

</head>


<body>

<div class="container-fluid">

    <div class="well bg-color">
        <h2 class="text-center">PayPal for Marketplaces &bull; <a href="#readme" class="light-links">Readme</a></h2>
    </div>

</div>
