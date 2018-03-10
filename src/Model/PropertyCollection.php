<?php


namespace Zenwalker\CommerceML\Model;


/**
 * Class ValueProperties
 *
 * @package Zenwalker\CommerceML\Model
 */
class PropertyCollection extends Simple
{
    /**
     * @param $id
     * @return Property|null
     */
    public function getById($id)
    {
        foreach ($this as $property) {
            if ($property->id == (string)$id) {
                return $property;
            }
        }
        return null;
    }

    protected function loadPropertiesValue()
    {
        foreach ($this->xml->ЗначенияСвойства as $property) {
            $properties = $this->owner->classifier->getProperties();
            $object = clone $properties->getById($property->Ид);
            $object->productId = (string)$this->xpath('..')[0]->Ид;
            $object->init();
            $this->append($object);
        }
    }

    protected function loadProperties()
    {
        foreach ($this->xml->Свойство as $property) {
            $this->append(new Property($this->owner, $property));
        }
    }

    public function init()
    {
        if ($this->xml && $this->xml->ЗначенияСвойства) {
            $this->loadPropertiesValue();
        }
        if ($this->xml && $this->xml->Свойство) {
            $this->loadProperties();
        }
        parent::init();
    }
}