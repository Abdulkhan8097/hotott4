<?php
class Foo
{}

class Foo1
{
}

class Foo2
{

    public function foo()
    {
    }
}

interface Foo3
{


}

trait Foo4
{

}

class Foo5
{
    // Comment here
}

class Foo6
{



    public const X = 1;
}

$instance = new class extends \Foo implements \HandleableInterface {

    // Class content
};

$instance = new class extends \Foo implements \HandleableInterface {
    // Class content
};

enum Valid
{
}

enum Invalid
{

}
