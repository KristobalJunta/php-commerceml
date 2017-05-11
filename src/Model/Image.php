<?php


namespace Zenwalker\CommerceML\Model;


use Zenwalker\CommerceML\ORM\Model;

/**
 * Class Image
 * @package Zenwalker\CommerceML\Model
 * @property string path
 * @property string caption
 */
class Image extends Model
{
    public function init()
    {
        foreach ($this->xml as $image) {
            $this->append(new Image($this->owner, $image));
        }
    }

    public function getPath()
    {
        return (string)$this->xml;
    }

    public function getCaption()
    {
        if ($xml = $this->xml->xpath("//ЗначениеРеквизита[contains(Значение, '{$this->path}#')]")) {
            return array_slice(explode('#', (string)$xml[0]->Значение), 1);
        } else {
            return null;
        }
    }
}