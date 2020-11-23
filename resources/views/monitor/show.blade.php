<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/uikit-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/monitor.css') }}">
</head>
<body>
    @include('monitor.corners')

    <div id="contnet" class="uk-container uk-container-expand"></div>
    <span id="seconds" style="font-size: 1.5em; position: absolute; right: 15px; bottom: 15px;" hidden>10</span>

    <script src="{{ url('js/uikit.min.js') }}"></script>
    <script src="{{ url('js/uikit-icons.min.js') }}"></script>
    <script src="{{ url('js/moment-with-locales.min.js') }}"></script>
    <script>
        setTimeout(() => { document.location.reload(); }, 1000 * 60 * 5);

        setTimeout(() => {loadContnet()}, 50);

        var screen = '{{ $screen }}';
        var fingerprint = '';
        var url = "{{ route('api.monitor', ['screen' => $screen, 'fingerprint' => 'xxxx']) }}";
        var seconds = 10;

        var timer = setInterval(() => {
            seconds--;
            if(seconds === 0) {
                loadContnet();
                seconds = 10;
            }
            document.getElementById('seconds').innerText = seconds;
        }, 5000);

        function loadContnet() {
            fetch(url.replace('xxxx', fingerprint))
                .then(res => res.json())
                .then(data => {
                    if (data.fingerprint !== fingerprint) {
                        document.getElementById('contnet').innerHTML = data.html;
                        fingerprint = data.fingerprint;
                    }
                })
                .catch(err => {
                    clearInterval(timer);

                    var html = `
                    <div class="uk-alert-danger uk-text-center uk-margin-xlarge-top uk-text-large" uk-alert>
                        <p>حصل خطأ غير معروف. الرجاء إصلاح الخطأ ثم تحديث الصفحة</p>
                        <p>${err}</p>
                        <div small-countdown="date: -time-">
                            <span class="small-countdown-number small-countdown-seconds"></span>
                            <span class="small-countdown-separator">:</span>
                            <span class="small-countdown-number small-countdown-minutes"></span>
                        </div>
                    </div>
                    `.replace('-time-', moment().add(2, 'minutes').format());
                    document.getElementById('contnet').innerHTML = html;
                    console.error(err);
                    console.log(url + fingerprint);

                    setTimeout(() => { document.location.reload(); }, 1000 * 60 * 2);
                });
        }
    </script>
</body>
</html>
