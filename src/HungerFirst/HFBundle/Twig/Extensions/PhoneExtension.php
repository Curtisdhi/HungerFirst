<?php

namespace HungerFirst\HFBundle\Twig\Extensions;

class PhoneExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('phone', array($this, 'phoneFilter')),
        );
    }

    /**
     * Convert unformated phone numbers to a format
     * @param string $number
     * @return string
     */
    public function phoneFilter($number)
    {
        $pattern = "/^(\d{3})(\d{3})(\d{1,4})$|^(\d{3})(\d{1,3})$|^(\d{3})$/";
        $replace = function ($m) {
            //(555)555-5555
            $str = "";
            if (isset($m[0])) $str = "($m[1])$m[2]-$m[3]";
            if (isset($m[4])) $str = "($m[4])$m[5]-";
            if (isset($m[6])) $str = "($m[6])";
            return $str;
        };

        $phone = preg_replace_callback($pattern, $replace, $number);

        return $phone;
    }

    public function getName()
    {
        return 'phone_extension';
    }
}