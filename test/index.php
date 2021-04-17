<?php

//
// La clase de almacenamiento genérico ayuda a administrar datos globales.
// Aquí el error es 'global'. Ningún dato debería ser realmente global:
// como máximo en toda la solicitud.
//
// @category Zend
// @package Zend_Registry
// @copyright Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
// @license http://framework.zend.com/license/new-bsd New BSD License
//
class Zend_Registry extends ArrayObject
{
//
    //Nombre de clase del objeto de registro singleton.
    //@var cadena "string"
    //
    private static $_registryClassName = 'Zend_Registry';

//
    // El objeto de registro proporciona almacenamiento para objetos compartidos.
    // @var Zend_Registry
    //
    private static $_registry = null;
//
    // Recupera la instancia de registro predeterminada.
    // Un Singleton es una receta para ocultar dependencias de una clase.
    //
    // @return Zend_Registry
    //
    public static function getInstance()
    {
        if (self::$_registry === null) {
            self::init();
        }

        return self::$_registry;
    }
//
    // Inicializar la instancia de registro predeterminada.
    //
    // @return void
    //
    protected static function init()
    {
        self::setInstance(new self::$_registryClassName());
    }
//
    // método getter, básicamente igual que offsetGet ().
    //
    // Este método se puede llamar desde un objeto de tipo Zend_Registry, o se puede llamar estáticamente.
    // En el último caso, utiliza el valor predeterminado en la instancia estática almacenada en la clase.
    //
    // @param string $ index - obtiene el valor asociado con $ index
    // @return mezclado "mixed"
    // @throws Zend_Exception si no se registra ninguna entrada para $ index.
    //
    public static function get($index)
    {
        $instance = self::getInstance();

        if (!$instance->offsetExists($index)) {
            require_once 'Zend/Exception.php';
            throw new Zend_Exception("No entry is registered for key '$index'");
        }
        return $instance->offsetGet($index);
    }

/**
 * setter method, basically same as offsetSet().
 *
 * This method can be called from an object of type Zend_Registry, or it
 * can be called statically. In the latter case, it uses the default
 * static instance stored in the class.
 *
 * @param string $index The location in the ArrayObject in which to store
 * the value.
 * @param mixed $value The object to store in the ArrayObject.
 * @return void
 */
    public static function set($index, $value)
    {
        $instance = self::getInstance();
        $instance->offsetSet($index, $value);
    }
/**
 * Returns TRUE if the $index is a named value in the registry,
 * or FALSE if $index was not found in the registry.
 *
 * @param string $index
 * @return boolean
 */
    public static function isRegistered($index)
    {
        if (self::$_registry === null) {
            return false;
        }
        return self::$_registry->offsetExists($index);
    }
/**
 * Constructs a parent ArrayObject with default
 * ARRAY_AS_PROPS to allow acces as an object
 *
 * @param array $array data array
 * @param integer $flags ArrayObject flags
 */
    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        parent::__construct($array, $flags);
    }
}
