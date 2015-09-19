<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/19
 * Time: 16:42
 */

class Context {

    private $offState;
    private $onState;
    private $currentState;

    public function __construct() {
        $this->offState = new OffState($this);
        $this->onState = new OnState($this);

        $this->currentState = $this->offState;
    }

    public function turnOnLight() {
        $this->currentState->turnLightOn();
    }

    public function turnOffLight() {
        $this->currentState->turnLightOff();
    }

    public function setState(IState $state) {
        $this->currentState = $state;
    }

    public function getOnState() {
        return $this->onState;
    }

    public function getOffState() {
        return $this->offState;
    }
}

interface IState {
    public function turnLightOn();
    public function turnLightOff();
}

class OnState implements IState {

    private $context;

    /**
     * OnState constructor.
     * @param $contextNow
     */
    public function __construct(Context $contextNow) {
        $this->context = $contextNow;
    }

    public function turnLightOn() {
        echo 'Light is already on -> take no action<br/>';
    }

    public function turnLightOff() {
        echo 'Lights off!';
        $this->context->setState($this->context->getOffState());
    }
}

class OffState implements IState {

    private $context;

    /**
     * OnState constructor.
     * @param $contextNow
     */
    public function __construct(Context $contextNow) {
        $this->context = $contextNow;
    }

    public function turnLightOn() {
        echo 'Lights on!';
        $this->context->setState($this->context->getOnState());
    }

    public function turnLightOff() {
        echo 'Light is already off -> take no action<br/>';
    }
}

