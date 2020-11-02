<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
    <style>
        @font-face {
            font-family: hanimation;
            src: url(http://screens.hsn/fonts/hanimation-regular.ttf);
        }
        html {
            background: rgb(180,212,187);
            background: -moz-linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            background: -webkit-linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            background: linear-gradient(90deg, rgba(180,212,187,1) 0%, rgba(179,224,210,1) 35%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#b4d4bb",endColorstr="#b3e0d2",GradientType=1);

            font-family: hanimation !important;
        }
        body, h1, h2, h3, div {
            font-family: hanimation !important;
        }
        .arial {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <div id="contnet" class="uk-container uk-container-expand"></div>

    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
    <script src="{{ url('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ url('js/moment-with-locales.min.js') }}"></script>
    <script>
        var screen = '{{ $screen }}';

        setTimeout(() => {loadContnet();}, 50);

        setInterval(() => { loadContnet(); }, 10000);

        function loadContnet() {
            fetch('/api/screen/' + screen)
                .then(res => res.text())
                .then(res => document.getElementById('contnet').innerHTML = res)
                .catch(err => console.log(err));
        }
    </script>
</body>
</html>
