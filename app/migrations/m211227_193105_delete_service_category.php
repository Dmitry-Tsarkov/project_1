<?php

use yii\db\Migration;

/**
 * Class m211227_193105_delete_service_category
 */
class m211227_193105_delete_service_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-services-category_id', 'services');
        $this->dropIndex('idx-services-category_id', 'services');
        $this->dropTable('service_categories');
        $this->dropColumn('services', 'category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('service_categories', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'image' => $this->string(255)->defaultValue(null),
            'image_hash' => $this->string(255)->defaultValue(null),
            'meta_t' => $this->string()->defaultValue(null),
            'meta_d' => $this->string()->defaultValue(null),
            'meta_k' => $this->string()->defaultValue(null),
            'h1' => $this->string()->defaultValue(null),
        ]);

        $this->insert('service_categories',
            [
                'created_at' => time(),
                'updated_at' => time(),
                'title' => 'Без категории',
                'alias' => '',
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
            ]);

        $this->createIndex(
            'idx-services-category_id',
            'services',
            'category_id'
        );
        $this->addForeignKey(
            'fk-services-category_id',
            'services',
            'category_id',
            'service_categories',
            'id',
            'CASCADE'
        );
    }
}
