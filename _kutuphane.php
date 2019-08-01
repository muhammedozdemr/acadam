<?php

  ############### Bu dosyada, program genelinde kullanılan kütüphane fonksiyonları bulunacak
  ############### Bu dosyada, program genelinde kullanılan kütüphane fonksiyonları bulunacak

  // dd:
  // Değişkenlerin içeriğinin ekrana yazılması işini yapar
  function dd($degisken) {
    echo "<pre>";
    if(is_array($degisken)) {
      print_r($degisken);
    } else {
      echo $degisken;
    }
    echo "</pre>";
  }
