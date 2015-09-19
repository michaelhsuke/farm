<html>
<head>
    <title>Welcome</title>
</head>

<body>
    <h1>Weclome to paractice farm!</h1>
    <?php
    include('./class/FarmCurl.php');
//    $endpoint = "https://oauth.api.189.cn/emp/oauth2/v3/authorize";

    // Use one of the parameter configurations listed at the top of the post
    $str = "you feed back is:\n 'no cool!'\n";
//    echo nl2br($str);
//    echo ucwords($str) . '<br/>';
//
//    echo addslashes($str);
//    echo get_magic_quotes_gpc();
    $str2 = 'Apple\tOrange\tBanana';
    $fruit = explode('\t', $str2);
    echo '<pre>';
    print_r($fruit);
    echo '</pre>';

    $str2 = implode('@*', $fruit);
//    print $str2;

    $who = array(
        'name' => 'Michael Jackson',
        'job' => 'Singer',
        'country' => 'USA'
        );
//    extract($who);

//    echo $name . ' is a ' . $job . '. Awesome!<br/>';

    $cursor = reset($who);
    $cursor = next($who);
    $cursor = each($who);
//    echo 'Current cursor is: ' . $cursor;
//
//    $value = end($who);
//    while ($value) {
//        echo "$value<br/>";
//        $value = prev($who);
//    }
//
//    $value = reset($who);
//    while ($value) {
//        echo "$value<br/>";
//        $value = next($who);
//    }

    $toaddress = 'feedback@example.com';
    $feedback = 'delivery';

    if (strstr($feedback, 'shop')) {
        $toaddress = 'retail@example.com';
    } else if (strstr($feedback, 'delivery')) {
        $toaddress = 'fulfillment@example.com';
    } else if (strstr($feedback, 'bill')) {
        $toaddress = 'accounts@example.com';
    }

    $result = "Because the feedback is {$feedback}, so we go the {$toaddress}.\n";
//    print nl2br($result);


    $bodytag = str_replace("%body%", "black", "<body text='%body%'>");
//    echo addslashes($bodytag);
//    echo htmlentities($bodytag);

    class Person {
        private $attr;
        private $age;

        function __get($name)
        {
            return $this->$name;
        }

        function __set($name, $value)
        {

//            echo $name . '<br/>';

            if($name == 'attr' && $value == "hello")
            {
                $this->$name = 'goodbye!';
            } else {
                $this->$name = $value;
            }
        }
    }

    $person = new Person();
    $person->attr = "hello";
    $person->age = 32;

    class Book {
        private $name;
        private $author;

        function __set($prop, $value) {
            $this->$prop = $value;
        }

        function __get($prop) {
            return $this->$prop;
        }

        function __toString() {
            return (var_export($this, TRUE));
        }

        function displayArray($arr) {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
        }

        function displayString($str) {
            echo "<h1>{$str}</h1>";
        }

        function __call($method, $args) {
            if ($method == 'display') {
                if (is_array($args[0])) {
                    $this->displayArray($args[0]);
                } else {
                    $this->displayString($args[0]);
                }
            }
        }
    }

    $my_book = new Book();
//    $my_book->name = 'GREEN STORIES';
//    printf("%s<br/>", $my_book->name);
//    echo $my_book;

//    $my_book->display(array(1, 2, 3));
    $my_book->display("Welcome");

    ?>
</body>
</html>