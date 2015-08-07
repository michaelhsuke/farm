<html>
<head>
    <title>Welcome</title>
</head>

<body>
    <h1>Weclome to paractice farm!</h1>
    <?php
    include('./class/FarmCurl.php');
    $endpoint = "https://oauth.api.189.cn/emp/oauth2/v3/authorize";

    // Use one of the parameter configurations listed at the top of the post
    $params = array(
        'app_id' => C('APP_ID'),
        'redirect_uri' => 'http://www.189pai.com/push',
        'response_type' => 'code'
    );
    $farmCurl = new FarmCurl()
    ?>
</body>
</html>