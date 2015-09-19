<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/8
 * Time: 16:31
 */

class SubObject {
    static $instances = 0;
    public $instance;

    public function __construct() {
        $this->instance = ++self::$instances;
    }

    public function __clone() {
        $this->instance = ++self::$instances;
    }
}

class MyClonable {
    public $object1;
    public $object2;

    public function __clone() {
        $this->object1 = clone $this->object1;
    }
}

// clone·½·¨

class Television {
    protected $id = 0;
    protected $width = 300;
    protected $height = 200;
    protected $color = 'black';
    protected $controller = null;

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = (string)$color;
    }

}

// Organizational Prototype
abstract class IAcmePrototype {
    protected $name;
    protected $id;
    protected $employeePic;
    protected $dept;

    abstract function setDept($orgCode);
    abstract function getDept();

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmployeePic()
    {
        return $this->employeePic;
    }

    /**
     * @param mixed $employeePic
     */
    public function setEmployeePic($employeePic)
    {
        $this->employeePic = $employeePic;
    }

    abstract function __clone();
}

class Marketing extends IAcmePrototype {
    const UNIT = "Marketing";
    private $sales = 'sales';
    private $promotion = 'promotion';
    private $strategic = 'strategic planning';

    function setDept($orgCode)
    {
        switch($orgCode) {
            case 101:
                $this->dept = $this->sales;
                break;
            case 102:
                $this->dept = $this->promotion;
                break;
            case 103:
                $this->dept = $this->strategic;
                break;
            default:
                $this->dept = 'Unrecognized Marketing';
        }
    }

    function getDept()
    {
        return $this->dept;
    }

    function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

class Management extends IAcmePrototype {
    const UNIT = "Management";
    private $research = 'research';
    private $plan = 'planning';
    private $operations = 'operations';

    function setDept($orgCode)
    {
        switch($orgCode) {
            case 201:
                $this->dept = $this->research;
                break;
            case 202:
                $this->dept = $this->plan;
                break;
            case 203:
                $this->dept = $this->operations;
                break;
            default:
                $this->dept = 'Unrecognized Management';
        }
    }

    function getDept()
    {
        return $this->dept;
    }

    function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

class Engineering extends IAcmePrototype {
    const UNIT = "Engineering";
    private $development = 'programming';
    private $design = 'digital artwork';
    private $sysAdmin = 'system administration';

    function setDept($orgCode)
    {
        switch($orgCode) {
            case 301:
                $this->dept = $this->development;
                break;
            case 302:
                $this->dept = $this->design;
                break;
            case 303:
                $this->dept = $this->sysAdmin;
                break;
            default:
                $this->dept = 'Unrecognized Engineering';
        }
    }

    function getDept()
    {
        return $this->dept;
    }

    function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

