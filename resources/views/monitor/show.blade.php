<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
    <style>
        @font-face {
            font-family: hanimation;
            src: url("{{ url('fonts/hanimation-regular.ttf') }}");
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
            font-family: Arial, Helvetica, sans-serif !important;
        }
    </style>
</head>
<body>
    <div id="contnet" class="uk-container uk-container-expand"></div>
    <span id="seconds" style="font-size: 1.5em; position: absolute; right: 15px; bottom: 15px;">0</span>

    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
    <script src="{{ url('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ url('js/moment-with-locales.min.js') }}"></script>
    <script>
        setTimeout(() => {loadContnet()}, 50);

        var screen = '{{ $screen }}';
        var fingerprint = '';
        var url = "{{ route('api.monitor', ['screen' => $screen, 'fingerprint' => 'xxxx']) }}";
        var seconds = 0;

        var timer = setInterval(() => {
            seconds++;
            if(seconds > 10) {
                loadContnet();
                seconds = 1;
            }
            document.getElementById('seconds').innerText = seconds;
        }, 1000);

        function loadContnet() {
            fetch(url.replace('xxxx', fingerprint))
                .then(res => res.json())
                .then(data => {
                    if (data.fingerprint !== fingerprint) {
                        document.getElementById('contnet').innerHTML = data.html;
                        fingerprint = data.fingerprint;
                        console.log('New Content: ' + data.fingerprint);
                    }
                })
                .catch(err => {
                    clearInterval(timer);
                    var html = `<div class="uk-alert-danger uk-text-center uk-margin-xlarge-top uk-text-large" uk-alert><p>حصل خطأ غير معروف. الرجاء إصلاح الخطأ ثم تحديث الصفحة</p><p>${err}</p></div>`;
                    document.getElementById('contnet').innerHTML = html;
                    console.error(err);
                    console.log(url + fingerprint);
                });
        }
    </script>
</body>
</html>
