<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/7
 * Time: 17:47
 */

// Factory

// Product
interface IProduct {
    public function getProperties();
}

class TextProduct implements IProduct {

    private $mfgProduct;
    public function getProperties() {
        $this->mfgProduct = <<< MARIO
        <!DOCTYPE html>
        <html>
            <head></head>
            <body></body>
        </html>
MARIO;

        return $this->mfgProduct;
    }
}

class GraphicProduct implements IProduct {

    private $mfgProdcut;
    public function getProperties() {
        $this->mfgProdcut = 'This is a graphic product.';
        return $this->mfgProdcut;
    }
}

// Factory
abstract class Creator {
    protected abstract function factoryMethod();

    public function startFactory() {
        $mfg = $this->factoryMethod();
        return $mfg;
    }
}

class TextFactory extends Creator {
    protected function factoryMethod() {
        $product = new TextProduct();
        return ($product->getProperties());
    }
}

class GraphicFactory extends Creator {
    protected function factoryMethod() {
        $product = new GraphicProduct();
        return ($product->getProperties());
    }
}

class FactoryClient {

    private $someGraphicObject;
    private $someTextObject;

    public function __construct() {
        $this->someGraphicObject = new GraphicFactory();
        echo $this->someGraphicObject->startFactory();
    }
}

// NEW FACTORY

abstract class NewCreator {

    protected abstract function factoryMethod(INewProduct $prodcut);

    public function doFactory(INewProdcut $prodcut) {
        $this->factoryMethod($prodcut);
    }
}