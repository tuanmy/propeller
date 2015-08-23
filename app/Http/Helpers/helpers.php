<?php 

class Helper {
 	public static function isUrlExist($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
      }
     public static function cutString($str, $limit = 50, $break = false, $strip = false) {
        $str = ($strip == true) ? strip_tags($str) : $str;
        if (strlen($str) > $limit) {
            $str = mb_substr($str, 0, $limit, "utf-8");
            if ($break) {
                return (substr($str, 0, strrpos($str, ' ')) . '...');
            }
            return $str . '...';
        }
        return trim($str);
    }
 
}
 
?>