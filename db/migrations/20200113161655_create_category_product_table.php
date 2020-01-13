<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryProductTable extends AbstractMigration {
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up() {
        $products = $this->table('category_product', ['id' => false, 'primary_key' => ['category_id', 'product_id']]);
        $products->addColumn('category_id', 'integer', ['null' => false])
            ->addColumn('product_id', 'integer', ['null' => false])
            ->addForeignKey('category_id', 'category', 'id',
                ['delete'=> 'CASCADE', 'update'=> 'RESTRICT'])
            ->addForeignKey('product_id', 'products', 'id',
                ['delete'=> 'CASCADE', 'update'=> 'RESTRICT'])->create();
    }

    public function down() {
        $this->table('category_product')->dropForeignKey('category_id')
            ->dropForeignKey('product_id')->drop()->save();
    }
}
