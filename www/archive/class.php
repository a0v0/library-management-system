<?php
class Student
{
    public $seat;
    function __construct($seat)
    {
        $this->seat = $seat;
    }
    function getName()
    {
        return "This is $this->seat";
    }
}
class Brand extends Student
{
    public function drive()
    {
        return "Driving cr having " . $this->seat . " seats";
    }
}
$student1 = new Student("50");
echo $Brand->drive();
