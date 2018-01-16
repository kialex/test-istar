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
namespace app\controllers;

use app\models\PhoneBook;
use yii\base\InvalidConfigException;
use yii\web\Controller;

/**
 * Class PhoneBookController
 *
 * Class PhoneBookController does not have anything yet
 *
 * @category   PhoneBookController
 * @package    app\controllers
 * @author     Vladislav Dneprov <vladislav.dneprov1995@gmail.com>
 * @author     GitHub https://github.com/kialex
 * @author     Linkedin https://www.linkedin.com/in/vladislav-dneprov/
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class PhoneBookController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $phoneBook = \Yii::createObject(PhoneBook::className());
        /** @var $phoneBook \app\models\PhoneBook */
        if ($phoneBook->load(\Yii::$app->request->post()) && $phoneBook->validate()) {
            if ($phoneBook->insert()) {
                \Yii::$app->session->setFlash('success', 'New contact has been created.');
                return $this->redirect('index');
            } else {
                \Yii::$app->session->setFlash('error', 'Error has occurred trying to add new contact.');
            }
        }
        
        return $this->render('create', ['phoneBook' => $phoneBook]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws InvalidConfigException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $phoneBook = $this->findModel($id);
        if ($phoneBook->load(\Yii::$app->request->post()) && $phoneBook->validate()) {
            if ($phoneBook->update()) {
                \Yii::$app->session->setFlash('success', 'Contact with id "'.$id.'" has been updated.');
                return $this->redirect('index');
            } else {
                \Yii::$app->session->setFlash('error', 'Error has occurred trying to update contact.');
            }
        }

        return $this->render('update', ['phoneBook' => $phoneBook]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws InvalidConfigException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionDelete($id)
    {
        $phoneBook = $this->findModel($id);
        if ($phoneBook->delete()) {
            \Yii::$app->session->setFlash('success', 'Contact with id "'.$id.'" has been updated.');
            return $this->redirect('index');
        } else {
            \Yii::$app->session->setFlash('error', 'Error has occurred trying to delete contact.');
        }

        return $this->goBack();
    }

    /**
     * @param $id
     * @return PhoneBook
     * @throws InvalidConfigException if PhoneBook with getting id not found.
     */
    protected function findModel($id)
    {
        $phoneBook = PhoneBook::findOne($id);
        if (!$phoneBook) {
            throw new InvalidConfigException(PhoneBook::className().' with id "'.$id.'" not found.');
        }

        return $phoneBook;
    }
}