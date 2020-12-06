<?php


namespace app\services;


use app\services\interfaces\DownloadData;
use app\services\interfaces\GetData;
use app\services\interfaces\ParseData;
use yii\httpclient\Client;
use yii\httpclient\Response;

/**
 * Class XmlParser
 * @package app\services
 */
class XmlParser implements DownloadData, GetData, ParseData
{
    /**
     * @var string|null
     */
    private ?string $url = null;
    /**
     * @var string|null
     */
    private ?string $path = null;
    /**
     * @var string|null
     */
    private ?string $data = null;
    /**
     * @var Response|null
     */
    private ?Response $response = null;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function download(): bool
    {
        if (is_null($this->url)) {
            $this->url = getenv('PARSE_URL');
        }

        $client = new Client();

        try {
            $response = $client->get($this->url)->send();
        } catch (\Throwable $e) {
            return false;
        }

        if ($response->isOk) {
            $this->response = $response;
            return true;
        }

        return false;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        if (is_null($this->data)) {
            if (!is_null($this->path)) {
                $data = file_get_contents($this->path);

                if ($data) {
                    $this->data = $data;
                }
            }
        }

        return $this->data;
    }

    /**
     * @param string|null $url
     * @return array|null
     */
    public function parseByUrl(?string $url = null): ?array
    {
        if (is_null($url)) {
            if (is_null($this->response) && !$this->download()) {
                return null;
            }

            try {
                return $this->response->getData();
            } catch (\Throwable $e) {
                return null;
            }
        }

        $this->setUrl($url);

        try {
            return $this->download() ? $this->response->getData() : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * @param string|null $data
     * @return array|null
     */
    public function parseByData(?string $data = null): ?array
    {
        if (is_null($data)) {
            if (is_null($this->getData())) {
                return ['ss'];
            }
        } else {
            $this->data = $data;
        }

        $response = new Response();
        $response->setContent($this->data);

        try {
            return (new \yii\httpclient\XmlParser())->parse($response);
        } catch (\Throwable $e) {
            return ['ss'];
        }
    }
}