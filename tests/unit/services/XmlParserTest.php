<?php


namespace services;


use app\services\XmlParser;
use yii\httpclient\Client;

class XmlParserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    public function testSetUrl()
    {
        $xmlParser = new XmlParser();

        $xmlParser->setUrl('http://www.cbr.ru/scripts/XML_daily.asp');

        expect_that($xmlParser->getUrl() == 'http://www.cbr.ru/scripts/XML_daily.asp');
    }

    public function testSetPath()
    {
        $xmlParser = new XmlParser();

        $xmlParser->setPath(__DIR__ . '/data/XML_daily.asp');

        expect_that($xmlParser->getPath() == __DIR__ . '/data/XML_daily.asp');

        $data = file_get_contents(__DIR__ . '/data/XML_daily.asp');

        expect_that($xmlParser->getData() == $data);
    }

    public function testSetData()
    {
        $xmlParser = new XmlParser();

        $data = file_get_contents(__DIR__ . '/data/XML_daily.asp');

        $xmlParser->setData($data);

        expect_that($xmlParser->getData() == $data);
    }

    public function testParseByUrl()
    {
        $xmlParser = new XmlParser();

        $result = $xmlParser->parseByUrl();

        try {
            $data = (new Client())->get(getenv('PARSE_URL'))->send()->getData();
        } catch (\Throwable $e) {
            $data = null;
        }

        expect_that($result == $data);

        $result = $xmlParser->parseByUrl('http://www.cbr.ru/scripts/XML_daily.asp');

        try {
            $data = (new Client())->get('http://www.cbr.ru/scripts/XML_daily.asp')->send()->getData();
        } catch (\Throwable $e) {
            $data = null;
        }

        expect_that($result == $data);
    }

    public function testParseByData()
    {
        $xmlParser = new XmlParser();
        $xmlParser->setPath(__DIR__ . '/data/XML_daily.asp');
        $result = $xmlParser->parseByData();

        expect_that(print_r($result, true) == file_get_contents(__DIR__ . '/data/output.txt'));

        $result = $xmlParser->parseByData(file_get_contents(__DIR__ . '/data/XML_daily.asp'));

        expect_that(print_r($result, true) == file_get_contents(__DIR__ . '/data/output.txt'));
    }
}