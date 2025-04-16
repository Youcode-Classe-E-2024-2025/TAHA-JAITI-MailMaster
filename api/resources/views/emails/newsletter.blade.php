<!DOCTYPE html>
<html>

<head>
    <title>{{ $newsletter->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #f4f4f4;
            padding: 10px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            font-size: 12px;
            text-align: center;
            color: #777;
        }

        .unsubscribe {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $newsletter->title }}</h1>
        </div>
        <div class="content">
            {!! $newsletter->content !!}
        </div>
        <div class="footer">
            <p>You received this email because you subscribed to our newsletter.</p>
            <p class="unsubscribe">
                <a href="{{ $unsubscribeUrl }}">Unsubscribe</a>
            </p>
            <img src="{{ $trackingUrl }}" alt="" width="1" height="1" />
        </div>
    </div>
</body>

</html>
