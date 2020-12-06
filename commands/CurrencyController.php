<?php


namespace app\commands;


use app\models\Currency;
use app\services\TableFiller;
use app\services\XmlParser;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class CurrencyController
 * @package app\commands
 */
class CurrencyController extends Controller
{
    /**
     * @var string
     */
    public $defaultAction = 'update';

    /**
     * Обновляет данные в таблице currency по
     * PARSE_URL, указанные в файле .env
     *
     * @return int
     * @throws \Throwable
     */
    public function actionUpdate()
    {
        $xmlParser = new XmlParser();

        echo "Загрузка данных...\n";

        $data = $xmlParser->parseByUrl();

        if (!is_null($data)) {
            $tableFiller = new TableFiller(Currency::tableName());

            echo "Вставка данных в таблицу " . Currency::tableName() . "...\n";

            $result = $tableFiller->fill($data['Valute'], [
                'name' => 'Name',
                'rate' => 'Value'
            ]);

            if ($result) {
                echo "Данные успешно обновлены!\n";
                return ExitCode::OK;
            }
        }

        echo "Произошла ошибка, попробуйте повторить позже\n";

        return ExitCode::OK;
    }
}