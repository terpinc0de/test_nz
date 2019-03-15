<?php

namespace app\modules\menu\migrations;

use yii\db\Migration;

/**
 * Class m180311_125425_menu_create_table
 */
class m180311_125425_menu_create_table extends Migration
{
    const NAME = 'menu_node';
    const PREFIXED = '{{%' . self::NAME . '}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PREFIXED, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'link' => $this->string()->defaultValue("#"),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::PREFIXED);
    }
}
