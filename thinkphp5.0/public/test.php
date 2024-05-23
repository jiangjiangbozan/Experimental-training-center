<?php
class Father
{
    public function __construct()
    {
        echo 'Father';
    }
}

class Son extends Father
{
    public function __construct()
    {
        parent::__construct();
        echo 'Son';
    }
}

$br = '<br/>';
$Father = new Father;

echo $br;

$Son = new Son;

