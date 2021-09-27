<?php

namespace App;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;
use League\Csv\Writer;

class ChatData
{
    private Reader $reader;
    private Writer $writer;

    public function __construct(string $csv)
    {
        $this->reader = Reader::createFromPath($csv, 'r');
        $this->reader->setHeaderOffset(0);
        $this->reader->setDelimiter(",");
        $this->writer = Writer::createFromPath($csv, 'a+');
    }

    public function chatLog(): TabularDataReader
    {
        return Statement::create()->process($this->reader);
    }

    public function sendToChat(array $data): string
    {
        return $this->writer->insertOne($data);
    }

    public function error(): string
    {
        return 'Username and Message fields must have value';
    }

}