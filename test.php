<?php

	class Solution {

    /**
     * @param Integer $n
     * @return String
     */
    function countAndSay($n) {
        
        if($n==1){
            $now = ''.$n.'';
        }
        else{
            echo $pre = $this->countAndSay($n - 1);

            $pre = strval($pre);
            $now = '';
            for($i = 0; $i < strlen($pre); $i++){
                $count = 1;

                while($pre[$i] == $pre[$i+$count]){
                    
                    $count++;
                }

                $i += $count - 1;
                $now .= $count.$pre[$i];
            }

        }
        return $now;
    }
}

$solution = new Solution();

 $data = $solution->countAndSay(4);