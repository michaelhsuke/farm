<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/8
 * Time: 17:47
 */

class DollarCalc {
    private $dollar;
    private $product;
    private $service;
    public $rate = 1;

    public function requestCalc($productNow, $serviceNow) {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->dollar = $this->product + $this->service;

        return $this->requestTotal();
    }

    public function requestTotal() {
        $this->dollar *= $this->rate;
        return $this->dollar;
    }
}

class EuroCalc {
    private $euro;
    private $product;
    private $service;
    public $rate = 1;

    public function requestCalc($productNow, $serviceNow) {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->euro = $this->product + $this->service;

        return $this->requestTotal();
    }

    public function requestTotal() {
        $this->euro *= $this->rate;
        return $this->euro;
    }
}

// ITarget
interface ITarget {
    function requester();
}

// EuroAdapter
class EuroAdapter extends EuroCalc implements ITarget {

    public function __construct() {
        $this->requester();
    }

    function requester()
    {
        $this->rate = .8111;
        return $this->rate;
    }
}

// Client
class AdapterClient {

    private $requestNow;
    private $dollarRequest;

    public function __construct() {
        $this->requestNow = new EuroAdapter();
        $this->dollarRequest = new DollarCalc();

        echo 'EURO' . $this->makeAdapterRequest($this->requestNow) . '<br/>';
        echo 'EURO' . $this->makeDollarRequest($this->requestNow) . '<br/>';
    }

    public function makeAdapterRequest(EuroAdapter $req) {
        return $req->requestCalc(40, 50);
    }

    public function makeDollarRequest(DollarCalc $req) {
        return $req->requestCalc(40, 50);
    }
}

// Composition Adapter
interface IFormat {
    public function formatCSS();
    public function formatGraphics();
    public function horizontalLayout();
}

class Desktop implements IFormat {
    private $head = '<head>';
    private $headClose = '</head><body>';
    private $cap = '</body></html>';
    private $sampleText;

    public function formatCSS()
    {
        echo $this->head;
        echo '<link rel="styelsheet" href="style.css" />';
        echo $this->headClose;
        echo '<h1>Hello, everyone!</h1>';
    }

    public function formatGraphics()
    {
        echo '<img src="test.png" />';
    }

    public function horizontalLayout()
    {
        $textFile = "text/lorem.txt";
        $openText = fopen($textFile, 'r');
        $textInfo = fread($openText, filesize($textFile));
        flose($openText);

        $this->sampleText = $textInfo;
        echo '<div>' . $this->sampleText . '</div>';
        echo $this->cap;
    }
}

// IMobileFormat
interface IMobileFormat {
    public function formatCSS();
    public function formatGraphics();
    public function verticalLayout();

}

class Mobile implements IMobileFormat {
    private $head = '<head>';
    private $headClose = '</head><body>';
    private $cap = '</body></html>';
    private $sampleText;

    public function formatCSS()
    {
        echo $this->head;
        echo '<link rel="styelsheet" href="style.css" />';
        echo $this->headClose;
        echo '<h1>Hello, everyone!</h1>';
    }

    public function formatGraphics()
    {
        echo '<img src="test.png" />';
    }

    public function verticalLayout()
    {
        $textFile = "text/lorem.txt";
        $openText = fopen($textFile, 'r');
        $textInfo = fread($openText, filesize($textFile));
        flose($openText);

        $this->sampleText = $textInfo;
        echo '<div>' . $this->sampleText . '</div>';
        echo $this->cap;
    }
}

class MobileAdapter implements IFormat {

    private $mobile;
    public function __construct(IMobileFormat $mobileNow) {
        $this->mobile = $mobileNow;
    }
    public function formatCSS()
    {
        $this->mobile->formatCSS();
    }

    public function formatGraphics()
    {
        $this->mobile->formatGraphics();
    }

    public function horizontalLayout()
    {
        $this->mobile->verticalLayout();
    }
}