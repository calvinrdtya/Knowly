<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting - {{ $meeting->subject }}</title>
    <script src="https://meet.jit.si/external_api.js"></script>
</head>
<body>
    <h1>Meeting: {{ $meeting->subject }}</h1>
    <div id="jitsi-container" style="height: 600px; width: 100%;"></div>

    <script>
        // Konfigurasi Jitsi Meet
        const domain = "meet.jit.si";
        const options = {
            roomName: "{{ $meeting->id }}",
            width: "100%",
            height: "100%",
            parentNode: document.querySelector('#jitsi-container'),
            userInfo: {
                displayName: "{{ $meeting->host }}"
            }
        };
        const api = new JitsiMeetExternalAPI(domain, options);
    </script>
</body>
</html>
