<?php

namespace HungerFirst\HFBundle\Twig\Extensions;

class TimeDiffExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'time_diff' => new \Twig_Filter_Method($this, 'timeDiff'),
        );
    }

    public function timeDiff($dateTime, $addAgo = true)
    {
        if ($dateTime == null) {
            return "Never";
        }
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0) {
           // throw new \InvalidArgumentException("time_diff is unable to handle dates in the future");
            //reverse delta
           $delta = -$delta;
        }

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = $time . " second" . (($time > 1) ? "s" : "");
        }
        else if ($delta <= 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "");
        }
        else if ($delta <= 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "");
        }
        else
        {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "");
        }

        if ($addAgo) {
            $duration .= " Ago";
        }
        return $duration;
    }

    public function getName()
    {
        return 'time_diff_extension';
    }
}