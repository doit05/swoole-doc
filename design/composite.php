<?php

/**
 * 将计算（变化的）封装起来
 *error 设计
 */
// abstract class Lesson
// {
//     protected $duration;
//     const FIXED = 1;
//     const TIMED = 2;
//     private $costType;
//
//     function __construct($duration, $costType = 1)
//     {
//         $this->duration = $duration;
//         $this->costType = $costType;
//     }
//
//     function cost(){
//         switch ($this->costType) {
//             case self :: TIMED:
//                 return (5 * $this ->duration);
//                 break;
//             case self::FIXED:
//                 return 30;
//                 break;
//             default:
//                 $this->costType = self::TIMED;
//                 return 30;
//                 break;
//         }
//     }
//
//     function chargeType(){
//         switch ($this->costType) {
//             case self :: TIMED:
//                 return "hourly rate";
//                 break;
//             case self::FIXED:
//                 return "fixed rate";
//                 break;
//             default:
//                 $this->costType = self::FIXED;
//                 return "fixed rate";
//                 break;
//         }
//     }
// }

/**
 * right done!
 */
class Lesson
{
    private $duration;
    private $costStrategy;
    function __construct($duration, CostStrategy $costStrategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $costStrategy;
    }

    function cost(){
        return $this->costStrategy->cost($this);
    }

    function chargeType(){
        return $this->costStrategy->chargeType();
    }

    function getDuration(){
        return $this->duration;
    }

    function setDuration($duration){
        $this->duration =$duration;
    }
}
/**
 * Lecture
 */
class Lecture extends Lesson{
}
/**
 *
 */
class Seminar extends Lesson
{
}

/**
 *
 */
abstract class CostStrategy
{
    abstract function cost(Lesson $lesson);
    abstract function chargeType();

}

/**
 *
 */
class TimedCostStrategy extends CostStrategy
{
    function cost(Lesson $lesson){
        return ($lesson->getDuration() * 5);
    }
    function chargeType(){
        return "hourly rate";
    }
}

/**
 *
 */
class FixedCostStrategy extends CostStrategy
{
    function cost(Lesson $lesson){
        return 30;
    }
    function chargeType(){
        return "fixed rate";
    }
}

// $lecture = new Lecture(5, Lesson::FIXED);
// $seminar = new Seminar(3, Lesson::TIMED);
// print "{$lecture->cost()} ({$lecture->chargeType()}) \n";
// print "{$seminar->cost()} ({$seminar->chargeType()}) \n";

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());
foreach ($lessons as $key => $lesson) {
    print "lesson charge: {$lesson->cost()}\n";
    print "lesson chargeType: {$lesson->chargeType()}\n";
    echo "-----------\n";
}


?>
