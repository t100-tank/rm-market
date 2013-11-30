<?php

class Common {
    static $tr = array(
        "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
        "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
        "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
        "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
        "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
        "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
        "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
        "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
        "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
        "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
        "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
        "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
        "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya"
    );

    static function translitIt($str) {
        return str_replace(array_keys(self::$tr), array_values(self::$tr), $str);
    }
    
    public static function quotJsonFix($in) {
        $repl = array(
            '[&quot;' => '["',
            '&quot;]' => '"]',
            '&quot;,&quot;' => '","'
        );
        return str_replace(array_keys($repl), array_values($repl), $in);
    }

    public static function makeAdvThumb($fileName) {
        $dispatcher = new sfEventDispatcher();
        $logger = new sfFileLogger($dispatcher, array('file' => sfConfig::get('sf_log_dir') . '/resize.log'));
        $fullPathName = sfConfig::get('sf_upload_dir') . '/' . sfConfig::get('app_adv_dir') . '/' . $fileName;

        $img = new sfImage($fullPathName);
        if ($img->getWidth() != sfConfig::get('app_adv_w') && $img->getHeight() != sfConfig::get('app_adv_h')) {
            $logger->log('Started:  '.$fullPathName);
            $img->thumbnail(sfConfig::get('app_adv_w'), sfConfig::get('app_adv_h'), 'fit');
            $img->saveAs($fullPathName);
            $logger->log('Finished: '.$fullPathName);
        }
        $logger->shutdown();
    }

    public static function slugify($text) {
        $text = self::translitIt($text);
        $text = strtolower(preg_replace("/[^a-z0-9_\-]+/i", '-', $text));
        $text = trim($text, '-');
        return $text;
    }

    public static function getFromPriceFormat($str, $delimiter = '.') {
        $str = preg_replace("/[^\d,\.]/", '', $str);
        $str = ($delimiter == '.') ?
                str_replace(',', '', $str):
                str_replace(',', '.', str_replace('.', '', $str) );
        return (double)$str;
    }
}