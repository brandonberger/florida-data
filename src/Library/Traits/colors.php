<?php
namespace Library\Traits;
trait Colors {
    public function findColor($string)
    {   
        $palette = ['00b894', '00cec9', '0984e3', '6c5ce7', 'fdcb6e', 
                    'e17055', 'd63031', 'e84393','55efc4','81ecec',
                    '74b9ff','a29bfe','ffeaa7','fab1a0','ff7675',
                    'fd79a8','1abc9c','2ecc71','3498db','9b59b6',
                    '16a085','27ae60','2980b9','8e44ad','f1c40f',
                    'e67e22','e74c3c','f39c12'];
        $colorUnicodes = [];
        foreach ($palette as $color) {
            $colorUnicode = 0;
            $color = str_split($color);
            foreach ($color as $char) {
                $colorUnicode += ord($char);
            }
            $colorUnicodes[] = $colorUnicode;
        }

        $string = str_split($string);
        $stringUnicode = 0;
        $multiplier = 1;
        foreach ($string as $char) {
            $stringUnicode += ord($char);
            $multiplier += 0.1;
        }
        $stringUnicode = $stringUnicode / $multiplier;

        $smallestDiff = null;
        $closest = null;
        foreach ($colorUnicodes as $key => $unicode) {
            $diff = abs($stringUnicode - $unicode);
            if ($smallestDiff && $closest) {
                if ($diff < $smallestDiff) {
                    $smallestDiff = $diff;
                    $closest = $palette[$key];
                } else {
                    continue;
                }
            } else {
                $smallestDiff = $diff;
                $closest = $palette[$key];
            }
        }

        return $closest;
        
    }

}

?>