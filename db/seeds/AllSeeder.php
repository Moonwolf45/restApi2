<?php


use Phinx\Seed\AbstractSeed;

class AllSeeder extends AbstractSeed {
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run() {
        $categoryData = [
            [
                'id' => 1,
                'parent_id' => 0,
                'title' => 'Кондуктор'
            ], [
                'id' => 2,
                'parent_id' => 0,
                'title' => 'Сверло алмазное'
            ], [
                'id' => 3,
                'parent_id' => 0,
                'title' => 'Отвертка'
            ], [
                'id' => 4,
                'parent_id' => 0,
                'title' => 'Компрессор'
            ], [
                'id' => 5,
                'parent_id' => 0,
                'title' => 'Полировальная паста'
            ], [
                'id' => 6,
                'parent_id' => 0,
                'title' => 'Метчик ручной'
            ], [
                'id' => 7,
                'parent_id' => 0,
                'title' => 'Силовое оборудование'
            ], [
                'id' => 8,
                'parent_id' => 7,
                'title' => 'Бетоносмесители'
            ], [
                'id' => 9,
                'parent_id' => 8,
                'title' => 'Бетономешалка'
            ], [
                'id' => 10,
                'parent_id' => 7,
                'title' => 'Обогреватели'
            ]
        ];

        $category = $this->table('category');
        $category->insert($categoryData)->saveData();

        $brandsData = [
            [
                'id' => 1,
                'title' => 'Зубр'
            ], [
                'id' => 2,
                'title' => 'Контур'
            ], [
                'id' => 3,
                'title' => 'Metabo'
            ], [
                'id' => 4,
                'title' => 'Bucovice Tools'
            ], [
                'id' => 5,
                'title' => 'Daire'
            ], [
                'id' => 6,
                'title' => 'REMEZA'
            ], [
                'id' => 7,
                'title' => 'Строймаш'
            ]
        ];

        $brands = $this->table('brands');
        $brands->insert($brandsData)->saveData();

        $productsData = [
            [
                'id' => 1,
                'title' => 'Кондуктор для сверл алмазных трубчатых',
                'availability' => 1,
                'manufacturer' => 1,
                'price' => 228.31
            ], [
                'id' => 2,
                'title' => 'Сверло алмазное трубчатое по стеклу и кафелю',
                'availability' => 1,
                'manufacturer' => 1,
                'price' => 73.28
            ], [
                'id' => 3,
                'title' => 'Отвертка КОНТУР',
                'availability' => 1,
                'manufacturer' => 2,
                'price' => 17.17
            ], [
                'id' => 4,
                'title' => 'Basic 250-24 W OF Компрессор безмасляный 1.5кВт',
                'availability' => 1,
                'manufacturer' => 3,
                'price' => 11110.00
            ], [
                'id' => 5,
                'title' => 'Полировальная паста',
                'availability' => 1,
                'manufacturer' => 3,
                'price' => 532.80
            ], [
                'id' => 6,
                'title' => 'BS230 Пильное полотно',
                'availability' => 1,
                'manufacturer' => 3,
                'price' => 1258.00
            ], [
                'id' => 7,
                'title' => 'Метчик ручной BUCOVICE М 4 шаг 0.7',
                'availability' => 1,
                'manufacturer' => 4,
                'price' => 96.48
            ], [
                'id' => 8,
                'title' => 'Обогреватель ЗУБР "МАСТЕР" инфракрасный, рифлёная панель, потолочный, закрытого типа, ТЭН, 1,0кВт, 2,2 м, 220В',
                'availability' => 1,
                'manufacturer' => 1,
                'price' => 2259.66
            ], [
                'id' => 9,
                'title' => 'Обогреватель инфракрасный HC 40',
                'availability' => 1,
                'manufacturer' => 5,
                'price' => 7464.16
            ], [
                'id' => 10,
                'title' => '**AB 100-850-SPE390R',
                'availability' => 1,
                'manufacturer' => 6,
                'price' => 112501.02
            ], [
                'id' => 11,
                'title' => 'Бетономешалка (бетоносмеситель), чугунный венец, ЗУБР "МАСТЕР" БС-120-600, 120 л, 600Вт',
                'availability' => 0,
                'manufacturer' => 1,
                'price' => 9145.37
            ], [
                'id' => 12,
                'title' => 'Бетоносмеситель СБР-500А.1, 500 л, 1,5 кВт, 380 В, редуктор',
                'availability' => 0,
                'manufacturer' => 7,
                'price' => 72800.00
            ]
        ];

        $products = $this->table('products');
        $products->insert($productsData)->saveData();

        $categoryProductData = [
            [
                'category_id' => 1,
                'product_id' => 1
            ], [
                'category_id' => 2,
                'product_id' => 2
            ], [
                'category_id' => 3,
                'product_id' => 3
            ], [
                'category_id' => 4,
                'product_id' => 4
            ], [
                'category_id' => 5,
                'product_id' => 5
            ], [
                'category_id' => 5,
                'product_id' => 6
            ], [
                'category_id' => 6,
                'product_id' => 7
            ], [
                'category_id' => 10,
                'product_id' => 8
            ], [
                'category_id' => 10,
                'product_id' => 9
            ], [
                'category_id' => 7,
                'product_id' => 10
            ], [
                'category_id' => 9,
                'product_id' => 11
            ], [
                'category_id' => 8,
                'product_id' => 12
            ]
        ];

        $categoryProduct = $this->table('category_product');
        $categoryProduct->insert($categoryProductData)->saveData();
    }
}
