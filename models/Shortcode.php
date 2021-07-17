<?php

/**
 * Класс Shortcode - модель для работы с ссылками
 */
class Shortcode {
    // набор символов для генерации уникального ключа
    const LETTERS = '123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ';

    public static function urlExistsInDb($url) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM short_urls WHERE long_url = :url';

        $result = $db->prepare($sql);
        $result->bindParam(':url', $url, PDO::PARAM_STR);
        $result->execute();

        $short_code = $result->fetch();

        return $short_code ? $short_code['short_code'] : false;
    }

    public static function createShortCode($url) {
        $count = strlen(Shortcode::LETTERS);
        $intval = time();
        $short_c = '';
        for($i = 0; $i < 4; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $short_c .= Shortcode::LETTERS[$last];
        }
        $result_short_code = $short_c . $intval;

        $db = Db::getConnection();

        $sql = 'INSERT INTO short_urls '
                . '(long_url, short_code, counter) '
                . 'VALUES '
                . '(:url, :short_c, 0)';

        $result = $db->prepare($sql);
        $result->bindParam(':url', $url, PDO::PARAM_STR);
        $result->bindParam(':short_c', $result_short_code, PDO::PARAM_STR);
        if ($result->execute()) {
            $id = $db->lastInsertId();
            $stmt = $db->prepare("SELECT * FROM short_urls WHERE id=?");
            $stmt->execute([$id]);
            $lastrow = $stmt->fetchObject();
            return $lastrow->short_code;
        }
        return false;
    }

    public static function getUrlByKey($key) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM short_urls WHERE short_code = :key';

        $result = $db->prepare($sql);
        $result->bindParam(':key', $key, PDO::PARAM_STR);
        $result->execute();

        $url = $result->fetch();

        return $url ? $url['long_url'] : false;
    }

    public static function incrementCount($key) {
        $db = Db::getConnection();

        $sql = "UPDATE short_urls
            SET 
                counter = counter + 1 
            WHERE short_code = :key";

        $result = $db->prepare($sql);
        $result->bindParam(':key', $key, PDO::PARAM_STR);
        
        return $result->execute();
    }
}