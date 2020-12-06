<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m201205_115938_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'rate' => $this->double()->notNull(),
            'insert_dt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
