<?php

namespace app\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class ArrayBehavior extends Behavior
{
    CONST ACTION_CONVERT_TO_ARRAY = 'convertToArray';

    CONST ACTION_CONVERT_TO_JSON = 'convertToJson';

    /** @var array  */
    public $attributes = [];

    /** @var array  */
    public $events = [];

    /**
     * Use only if you want check json string, so you will get it in Array, but After Validate you will have string json again
     * @var bool
     */
    public $json_input = false;

    /**
     * @return array
     */
    public function events()
    {
        if ($this->events) {
            return $this->events;
        }

        if ($this->json_input) {
            return [
                ActiveRecord::EVENT_BEFORE_VALIDATE     => ArrayBehavior::ACTION_CONVERT_TO_ARRAY,
                ActiveRecord::EVENT_AFTER_VALIDATE      => ArrayBehavior::ACTION_CONVERT_TO_JSON,
            ];
        } else {
            return [
                ActiveRecord::EVENT_BEFORE_INSERT   => ArrayBehavior::ACTION_CONVERT_TO_JSON,
                ActiveRecord::EVENT_BEFORE_UPDATE   => ArrayBehavior::ACTION_CONVERT_TO_JSON,
                ActiveRecord::EVENT_AFTER_FIND      => ArrayBehavior::ACTION_CONVERT_TO_ARRAY,
                ActiveRecord::EVENT_AFTER_UPDATE    => ArrayBehavior::ACTION_CONVERT_TO_ARRAY,
                ActiveRecord::EVENT_AFTER_INSERT    => ArrayBehavior::ACTION_CONVERT_TO_ARRAY,
                ActiveRecord::EVENT_INIT            => ArrayBehavior::ACTION_CONVERT_TO_ARRAY,
            ];
        }
    }

    /**
     * Convert to Json
     * @param $event
     */
    public function convertToJson($event)
    {
        if ($this->attributes && is_array($this->attributes)) {
            foreach ($this->attributes as $attribute) {
                if (isset($this->owner->{$attribute}) && $this->owner->{$attribute} &&
                    (is_array($this->owner->{$attribute}) || is_object($this->owner->{$attribute}))) {
                    $this->owner->{$attribute} = json_encode($this->owner->{$attribute});
                }
            }
        }
    }

    /**
     * Convert to array
     * @param $event
     */
    public function convertToArray($event)
    {
        if ($this->attributes && is_array($this->attributes)) {
            foreach ($this->attributes as $attribute) {
                if (isset($this->owner->{$attribute}) && $this->owner->{$attribute} && is_string($this->owner->{$attribute})) {
                    $this->owner->{$attribute} = json_decode($this->owner->{$attribute}, true);
                }
            }
        }
    }
}