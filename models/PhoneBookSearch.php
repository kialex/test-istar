<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class PhoneBookSearch
 *
 * Used for search [[PhoneBook]]
 *
 * @category   PhoneBookSearch
 * @package    app\models
 * @author     Vladislav Dneprov <vladislav.dneprov1995@gmail.com>
 * @author     GitHub https://github.com/kialex
 * @author     Linkedin https://www.linkedin.com/in/vladislav-dneprov/
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class PhoneBookSearch extends Model
{
    /**
     * @param $data array data that will be loaded.
     * @return ActiveDataProvider provider with [[PhoneBook]] model.
     */
    public function search($data)
    {
        // load - coming soon
        // filter - coming soon
        // custom sort - comming soon
        return new ActiveDataProvider([
            'query' => PhoneBook::find(),
        ]);
    }
}