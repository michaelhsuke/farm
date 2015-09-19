<?php

/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/19
 * Time: 15:41
 */
abstract class AbstractClass {

    protected $pix;
    protected $cap;

    public function templateMethod($pixNow, $capNow) {
        $this->pix = $pixNow;
        $this->cap = $capNow;
        $this->addPix($this->pix);
        $this->addCaption($this->cap);
    }

    abstract protected function addPix($pix);
    abstract protected function addCaption($cap);
}

class ConcreteClass extends AbstractClass {

    protected function addPix($pix) {
        $this->pix = 'pix/' . $pix;
        $formatter = "<img src=$this->pix alt='pix image'><br/>";
        echo $formatter;
    }

    protected function addCaption($cap) {
        $this->cap = $cap;
        echo "<em>Caption:</em>" . $this->cap . "<br/>";
    }
}

function __autoload($class_name) {
    include $class_name . '.php';
}

/**
 * Abstract Template Method class
 */
abstract class TmAb {

    protected $pix;
    protected $cap;

    public function templateMethod() {
        $this->addPix();
        $this->addCaption();
    }

    protected abstract function addPix();
    protected abstract function addCaption();
}

class TmFac extends TmAb {

    protected function addPix() {
        $this->pix = new GraphicFactory2();
        echo $this->pix->doFactory();
    }

    protected function addCaption() {
        $this->cap = new TextFactory2();
        echo $this->cap->doFactory();
    }
}

abstract class Creator {

    protected abstract function factoryMethod();

    public function doFactory() {
        $mfg = $this->factoryMethod();
        return $mfg;
    }
}

class GraphicFactory2 extends Creator {

    protected function factoryMethod() {
        $product = new GraphicProduct();
        return $product->getProperties();
    }
}

class TextFactory2 extends Creator {

    protected function factoryMethod() {
        $product = new TextProduct();
        return $product->getProperties();
    }
}

/**
 * interface Product
 */
interface Product {
    public function getProperties();
}

class GraphicProduct implements Product {

    private $mfgProduct;

    public function getProperties() {

        $this->mfgProduct = 'Graphic Product';
        return $this->mfgProduct;
    }
}

class TextProduct implements Product {

    public function getProperties() {
        return 'Text Product';
    }
}

/**
 * Class IHook
 */
abstract class IHook  {

    protected $purchased;
    protected $hookSpecial;
    protected $shippingHook;
    protected $fullCost;

    public function templateMethod($total, $special) {
        $this->purchased = $total;
        $this->hookSpecial = $special;
        $this->addTax();
        $this->addShippingHook();
        $this->displayCost();
    }

    protected abstract function addTax();
    protected abstract function addShippingHook();
    protected abstract function displayCost();
}

