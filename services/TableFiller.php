<?php


namespace app\services;


/**
 * Class TableFiller
 * @package app\services
 */
class TableFiller
{
    /**
     * @var string
     */
    public string $tablename;

    /**
     * TableFiller constructor.
     * @param string $tablename
     */
    public function __construct(string $tablename)
    {
        $this->tablename = $tablename;
    }

    /**
     * Очищает и заполняет таблицу данными $data
     * $correspondence - массив соответсвий, где
     * $key - это название колонки в таблице $tablename
     * а $value - это название ключа в массиве $data
     *
     * @param array $data
     * @param array $correspondence
     * @return bool
     * @throws \Throwable
     */
    public function fill(array $data, array $correspondence): bool {

        $insertArray = [];

        try {
            foreach ($data as $row) {
                $rowArray = [];

                foreach ($correspondence as $value) {
                    $rowArray[] = $row[$value];
                }

                $insertArray[] = $rowArray;
            }
        } catch (\Throwable $e) {
            return false;
        }

        \Yii::$app->db->transaction(function (\yii\db\Connection $db) use ($correspondence, $insertArray) {
            $db
                ->createCommand()
                ->truncateTable($this->tablename)
                ->execute();
            $db
                ->createCommand()
                ->batchInsert($this->tablename, array_keys($correspondence), $insertArray)
                ->execute();
        });

        return true;
    }
}