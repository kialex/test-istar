<?php

namespace app\controllers;

use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\PhoneBook;
use app\models\PhoneBookSearch;

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
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'             => ['GET'],
                    'create'            => ['GET', 'POST',],
                    'update'            => ['GET', 'POST', 'UPDATE',],
                    'delete'            => ['POST', 'DELETE',],
                ],
            ],
        ];
    }

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

    /**
     * List of contacts.
     *
     * @return string render `phone-book/index` view.
     */
    public function actionIndex()
    {
        $filter = \Yii::createObject(PhoneBookSearch::className());
        $dataProvider = $filter->search(\Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'filter'        => $filter,
            'dataProvider'  => $dataProvider,
        ]);
    }

    /**
     * Create contact.
     *
     * @return string render `phone-book/create` view.
     */
    public function actionCreate()
    {
        $phoneBook = \Yii::createObject(PhoneBook::className());
        /** @var $phoneBook \app\models\PhoneBook */
        if ($phoneBook->load(\Yii::$app->request->post()) && $phoneBook->validate()) {
            if ($phoneBook->insert()) {
                \Yii::$app->session->setFlash('success', 'New contact has been created.');
                return $this->redirect(['index']);
            } else {
                \Yii::$app->session->setFlash('error', 'Error has occurred trying to add new contact.');
            }
        }
        
        return $this->render('create', ['phoneBook' => $phoneBook]);
    }

    /**
     * Update contact.
     *
     * @param $id int contact `id` that will be updated.
     * @return string render `phone-book/update` view or redirect to `index` action.
     */
    public function actionUpdate($id)
    {
        $phoneBook = $this->findModel($id);
        if ($phoneBook->load(\Yii::$app->request->post()) && $phoneBook->validate()) {
            if ($phoneBook->update()) {
                \Yii::$app->session->setFlash('success', 'Contact with id "'.$id.'" has been updated.');
                return $this->redirect(['index']);
            } else {
                \Yii::$app->session->setFlash('error', 'Error has occurred trying to update contact.');
            }
        }

        return $this->render('update', ['phoneBook' => $phoneBook]);
    }

    /**
     * Delete contact.
     *
     * @param $id int contact `id` that will be updated.
     * @return string redirect to `index` action.
     */
    public function actionDelete($id)
    {
        $phoneBook = $this->findModel($id);
        if ($phoneBook->delete()) {
            \Yii::$app->session->setFlash('success', 'Contact with id "'.$id.'" has been updated.');
            return $this->redirect(['index']);
        } else {
            \Yii::$app->session->setFlash('error', 'Error has occurred trying to delete contact.');
        }

        return $this->goBack();
    }

    /**
     * Find [[PhoneBook]] model by `id`
     *
     * @param $id [[PhoneBook]] id that will be found.
     * @return PhoneBook the model that was found
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