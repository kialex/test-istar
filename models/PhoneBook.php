<?php
/**
 * 2015-2018 Jaguar-Team
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@jaguar-team.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade JaguarTeam to newer
 * versions in the future. If you wish to customize JaguarTeam for your
 * needs please refer to http://www.jaguar-team.com for more information.
 *
 * @author    JaguarTeam LC <contact@jaguar-team.com>
 * @copyright 2015-2018 JaguarTeam LC
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace app\models;

use app\behaviors\ArrayBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class PhoneBook
 *
 * Class PhoneBook does not have anything yet
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
            // Last name rules
            ['last_name', 'trim'],
            ['last_name', 'string', 'min' => 1, 'max' => 255],
            // Patronymic rules
            ['patronymic', 'trim'],
            ['patronymic', 'string', 'min' => 1, 'max' => 255],
            // Phone rules
            ['phone', 'safe'],
        ];
    }
}