<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/19
 * Time: 14:44
 */

abstract class IComponent {
    protected $site;
    abstract public function getSite();
    abstract public function getPrice();
}

abstract class Decorator extends IComponent {

}

class BasicSites extends IComponent {
    public function __construct() {
        $this->site = 'Basic site';
    }

    public function getSite() {
        return $this->site;
    }

    public function getPrice() {
        return 1200;
    }
}

class Maintenance extends Decorator {

    public function __construct(IComponent $nowSite) {
        $this->site = $nowSite;
    }

    public function getSite() {
        $currentState = 'Maintenance';
        return $this->site->getSite() . $currentState;
    }

    public function getPrice() {
        return 950 + $this->site->getPrice();
    }
}

class Video extends Decorator {

    /**
     * Video constructor.
     */
    public function __construct(IComponent $nowSite) {
        $this->site = $nowSite;
    }

    public function getSite() {
        $current = '<h2>Video</h2>';
        return $this->site->getSite() . $current;
    }

    public function getPrice() {
        return 350 + $this->site->getPrice();
    }
}

/**
 * Developer Dating Service
 */

abstract class IDeveloperComponent {

    protected $date;
    protected $ageGroup;
    protected $feature;

    abstract public function setAge($nowAge);
    abstract public function getAge();
    abstract public function setFeature($nowFeature);
    abstract public function getFeature();
}

class Male extends IDeveloperComponent {


    /**
     * Male constructor.
     */
    public function __construct() {
        $this->date = 'Male';
        $this->setFeature('<h2>Dude programmer feature:</h2>');
    }

    public function setAge($nowAge) {
        // TODO: Implement setAge() method.
    }

    public function getAge() {
        // TODO: Implement getAge() method.
    }

    public function setFeature($nowFeature) {
        // TODO: Implement setFeature() method.
    }

    public function getFeature() {
        // TODO: Implement getFeature() method.
    }
}