<?php
namespace HungerFirst\HFBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PhoneNumberDataTransformer implements DataTransformerInterface {
    
    public function transform($number)
    {
        $pattern = "/^(\d{3})(\d{3})(\d{1,4})$|^(\d{3})(\d{1,3})$|^(\d{3})$/";
        $replace = function ($m) {
            //(555)555-5555
            $str = "";
            if (isset($m[0])) $str = "($m[1])$m[2]-$m[3]";
            if (isset($m[4])) $str = "($m[4])$m[5]";
            if (isset($m[6])) $str = "($m[6])";
            return $str;
        };
        $phone = preg_replace_callback($pattern, $replace, $number);
        return $phone;
    }

    public function reverseTransform($number)
    {
        $phone = preg_replace("/[^0-9]/", '', $number);
        //if area code is missing, prepend area code
        if (strlen($number) == 7) {
            $phone = '423'. $phone;
        }
        return $phone;
    }
    
}
