<?php


namespace models;


use app\models\Currency;
use app\tests\fixtures\CurrencyFixture;
use UnitTester;

class CurrencyTest extends \Codeception\Test\Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;


    public function _fixtures()
    {
        return [
            'profiles' => [
                'class' => CurrencyFixture::className(),
                'dataFile' => codecept_data_dir('currencies.php'),
            ]
        ];
    }

    /**
     * Тест добавления
     */
    public function testCreate()
    {
        $currency = new Currency();
        $currency->name = 'test3';
        $currency->rate = 15.15;
        expect_that($currency->save());
    }

    /**
     * Тест добавления с пустым полем
     */
    public function testCreateWithEmptyField()
    {
        $currency = new Currency();
        expect_not($currency->validate());
        expect_not($currency->save());

        $currency->name = 'test3';
        expect_not($currency->validate());
        expect_not($currency->save());

        $currency->name = null;
        $currency->rate = 23.32;
        expect_not($currency->validate());
        expect_not($currency->save());
    }

    /**
     * Тест на добавление не уникальных данных
     */
    public function testUniqueField()
    {
        $currency1 = new Currency();
        $currency1->name = 'test3';
        $currency1->rate = 22;
        expect_that($currency1->save());

        $currency2 = new Currency();
        $currency2->name = 'test3';
        $currency2->rate = 22;
        expect_not($currency2->validate());
        expect_not($currency2->save());
    }

    /**
     * Тест удаления
     */
    public function testDelete()
    {
        $currency = Currency::findOne(['name' => 'test2']);
        expect_that($currency !==  null);
        expect_that($currency->delete());
    }

    /**
     * Тест обновления данных
     */
    public function testUpdate()
    {
        $currency = Currency::findOne(['name' => 'test1']);
        expect_that($currency !==  null);
        $currency->name = 'test3';
        expect_that($currency->save());

        $updatedCurrency = Currency::findOne(['name' => 'test3']);
        expect_that($updatedCurrency !== null);
    }
}