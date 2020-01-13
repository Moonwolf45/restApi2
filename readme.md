# Test Rest

## Запуск миграций
php vendor/robmorgan/phinx/bin/phinx migrate

## Создаём тестовые данные
php vendor/robmorgan/phinx/bin/phinx seed:run

## 1. Получение товаров по ID
/api/products/id?param=:id (метод GET)

Пример: 
```
/api/products/id?param=5
```

## 2. Выдача товаров по вхождению подстроки в названии
/api/products/name?param=:str (метод GET)

Пример: 
```
/api/products/name?param=Отвертка
```

## 3. Выдача товаров по производителю/производителям
/api/products/brand?param=:str (метод GET)

Пример: 
```
/api/products/brand?param=5
или
/api/products/brand?param=6,7
```

## 4. Выдача товаров по разделу
/api/products/category?param=:id (метод GET)

Пример: 
```
/api/products/category?param=10
```

## 5. Выдача товаров по разделу и вложенным разделам
/api/products/all_category?param=:id (метод GET)

Пример: 
```
/api/products/category?param=7
```

#### Важно! Если функция не будет указана то вернётся абсолютно весь набор товаров 

