<?php

namespace Braintree;

abstract class Serializable
{
    protected $_attributes = array();

    public function serialize($as_object = false, $max_depth = PHP_INT_MAX)
    {
        $object = new \stdClass();
        if ($max_depth <= 0) return null;
        if (!isset($this->_attributes)) return $object;
        if (!is_array($this->_attributes)) return $object;

        foreach ($this->_attributes as $k => $attribute)
        {
            if ($attribute instanceof Serializable)
                 $object->$k = $attribute->serialize(true, $max_depth-1);
            else $object->$k = $attribute;
        }

        if ($as_object)
             return $object;
        else return json_encode($object);
    }
}

class_alias('Braintree\Serializable', 'Braintree_Serializable');
