<?php

use Phinx\Migration\AbstractMigration;

class CreateProductsTable extends AbstractMigration {
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
        $products = $this->table('products');
        $products->addColumn('title', 'string', ['null' => false, 'limit' => 255])
            ->addColumn('availability', 'smallinteger', ['null' => false, 'limit' => 1])
            ->addColumn('manufacturer', 'integer', ['null' => true])
            ->addColumn('price', 'decimal', ['null' => false, 'precision' => 12, 'scale' => 2,
                'default' => 0.00])
            ->addForeignKey('manufacturer', 'brands', 'id',
                ['delete'=> 'CASCADE', 'update'=> 'RESTRICT'])->create();
    }

    public function down() {
        $this->table('products')->drop()->save();
    }
}
