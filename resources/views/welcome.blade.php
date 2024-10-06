<!-- resources/views/webhook-test.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Google Chat Webhook Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .button { 
            padding: 10px 15px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        #response {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            display: none;
        }
    </style>
</head>
<body>
    <h1>Google Chat Webhook Test</h1>
    
    <button class="button" onclick="sendRequest('send-card')">Send Card</button>
    <button class="button" onclick="sendRequest('send-notification')">Send Notification</button>
    <button class="button" onclick="sendRequest('send-text')">Send Text</button>

    <div id="response"></div>

    <script>
    function sendRequest(endpoint) {
        $.ajax({
            url: '/' + endpoint,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#response').html(JSON.stringify(response, null, 2)).show();
            },
            error: function(xhr, status, error) {
                $('#response').html(xhr.responseText).show();
            }
        });
    }
    </script>
</body>
</html>