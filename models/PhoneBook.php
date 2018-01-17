<?php

namespace app\models;

use app\behaviors\ArrayBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class PhoneBook
 *
 * Table `phone_book`;
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string|array $phone
 *
 * @category   PhoneBook
 * @package    app\models
 * @author     Vladislav Dneprov <vladislav.dneprov1995@gmail.com>
 * @author     GitHub https://github.com/kialex
 * @author     Linkedin https://www.linkedin.com/in/vladislav-dneprov/
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class PhoneBook extends ActiveRecord
{
    /** Max phone number that user can add. */
    const MAX_PHONE_NUMBER = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%phone_book}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'         => ArrayBehavior::className(),
                'attributes'    => ['phone',],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // First name rules
            ['first_name', 'required'],
            ['first_name', 'trim'],
            ['first_name', 'string', 'min' => 1, 'max' => 255],
            ['first_name', 'match', 'pattern' => '/^[A-z]{1,255}$/i', 'message' => 'Allowable characters: A-z'],
            // Last name rules
            ['last_name', 'trim'],
            ['last_name', 'string', 'min' => 1, 'max' => 255],
            ['last_name', 'match', 'pattern' => '/^[A-z]{1,255}$/i', 'message' => 'Allowable characters: A-z'],
            // Patronymic rules
            ['patronymic', 'trim'],
            ['patronymic', 'string', 'min' => 1, 'max' => 255],
            ['patronymic', 'match', 'pattern' => '/^[A-z]{1,255}$/i', 'message' => 'Allowable characters: A-z'],
            // Phone rules
            ['phone', 'filterPhone'],
            ['phone', 'validatePhone'],
        ];
    }

    /**
     * Filter for [[phone]] attribute.
     *
     * Delete empty elements of array and duplicates.
     *
     * @param $attribute string name of phone numbers attribute.
     */
    public function filterPhone($attribute)
    {
        $phones = array_diff($this->phone, array(''));
        $this->phone = empty($phones) ? null : array_unique($phones);
    }

    /**
     * Checks whether [[phone]] is validate.
     *
     * Check the maximum number of phones. See [[MAX_PHONE_NUMBER]].
     * Each elements of array will be checked via `preg_match`. Pattern: `/^[\+0-9\-\(\)\s]*$/`.
     *
     * @param $attribute string name of phone numbers attribute.
     */
    public function validatePhone($attribute)
    {
        if (!empty($this->phone)) {
            $count = 1;
            foreach ($this->phone as $number) {
                if ($count > self::MAX_PHONE_NUMBER) {
                    $this->addError($attribute, 'Max phone  numbers is '.self::MAX_PHONE_NUMBER);
                    break;
                }
                if (!preg_match('/^[\+0-9\-\(\)\s]*$/', $number)) {
                    $this->addError($attribute, 'Allow symbols: 0-9+-()');
                    break;
                }
                $count++;
            }
        }
    }
}