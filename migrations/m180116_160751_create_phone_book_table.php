<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phone_book`.
 */
class m180116_160751_create_phone_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phone_book', [
            'id'            => $this->primaryKey(),
            'first_name'    => $this->string(255)->notNull(),
            'last_name'     => $this->string(255),
            'patronymic'    => $this->string(255),
            'phone'         => $this->text(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phone_book');
    }
}
