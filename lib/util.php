<?php
  //XSS対策のためのHTMLエスケープをするための関数
  function es ($data, $charset='UTF-8') {
    if(is_array($data)) {
      //実行中のメソッドに対して配列の要素を再帰呼び出し
      return array_map(__METHOD__, $data);
    } else {
      return htmlspecialchars($data, ENT_QUOTES, $charset);
    }
  }

  //配列の文字のエンコードチェックを行う関数
  function cken (array $data) {
    $result = true;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $value = implode("", $value);
      }
      if (!mb_check_encoding($value)) {
        //文字エンコードが一致しない時
        $resulut = false;
        break;
      }
    }
    return $result;
  }