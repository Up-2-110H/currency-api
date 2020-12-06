<?php


namespace app\services\interfaces;


/**
 * Interface GetData
 * @package app\services\interfaces
 */
interface GetData
{
    /**
     * Установка пути к файлу содаржащий данные
     * @param string $path
     */
    public function setPath(string $path): void;

    /**
     * Установка данных
     * @param string $data
     */
    public function setData(string $data): void;

    /**
     * Взятие данных
     * Возвращает $data, если она не пустая
     * Возвращает данные с файла, по пути $path, если она не пустая
     * Иначе возвращает null
     *
     * @return string|null
     */
    public function getData(): ?string;
}