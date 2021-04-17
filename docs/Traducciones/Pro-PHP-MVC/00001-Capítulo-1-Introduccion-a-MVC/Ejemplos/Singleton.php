<?php

// General singleton class.
class Singleton
{
    // Hold the class instance.
    private static $instance = null;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        // The expensive process (e.g.,db connection) goes here.
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Singleton();
        }

        return self::$instance;
    }
}

// All the variables point to the same object.
$object1 = Singleton::getInstance();
$object2 = Singleton::getInstance();
$object3 = Singleton::getInstance();

echo 'object1 = ';
var_dump($object1);
echo '<br/>';
echo 'object2 = ';
var_dump($object2);
echo '<br/>';
echo 'object3 = ';
var_dump($object3);
echo '<br/>';
echo '<br/>';
echo '=====================================================';
echo '<br/>';
echo 'Vemos si las instancias con varibles distintas hacen rteferencia al mismo objeto';
echo '<br/>';
echo '<br/>';

echo 'var_dump($object1 === $object2);';
echo '<br/>';
var_dump($object1 === $object2);
echo '<br/>';

echo 'var_dump($object2 === $object3);';
echo '<br/>';
var_dump($object2 === $object3);
echo '<br/>';

echo 'var_dump($object1 === $object3);';
echo '<br/>';
var_dump($object1 === $object3);

// Referencia
// https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php

class Singleton2
{
    function getInstance()
    {
        static $instance = null;

        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }
    function __construct()
    {
    }

    function __clone()
    {
    }

    function __wakeup()
    {
    }
}

class SingletonChild2 extends Singleton
{

}

echo '<br/>';

echo '===================================================';
echo '<br/>';
echo '<br/>';
echo '===================================================';
echo '<br/>';
echo 'En eta sección se comparan los objetos.';
echo '<br/>';
$obj = Singleton2::getInstance();
echo '<br/>';
var_dump($obj === Singleton2::getInstance());

$anotherObj = SingletonChild2::getInstance();
echo '<br/>';
var_dump($anotherObj === Singleton2::getInstance());
echo '<br/>';
var_dump($anotherObj === SingletonChild2::getInstance());
echo '<br/>';
