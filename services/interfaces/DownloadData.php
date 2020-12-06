<?php


namespace app\services\interfaces;


/**
 * Interface DownloadData
 * @package app\services\interfaces
 */
interface DownloadData
{
    /**
     * Установка url
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * Скачывание данных по $url
     * @return bool
     */
    public function download(): bool;
}