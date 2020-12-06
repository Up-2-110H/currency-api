<?php


namespace app\services\interfaces;


/**
 * Interface ParseData
 * @package app\services\interfaces
 */
interface ParseData
{
    /**
     * Парсит данные по $url в массив
     *
     * @param string|null $url
     * @return array|null
     */
    public function parseByUrl(string $url): ?array;

    /**
     * Парсит данные $data в массив
     *
     * @param string|null $data
     * @return array|null
     */
    public function parseByData(string $data): ?array;
}