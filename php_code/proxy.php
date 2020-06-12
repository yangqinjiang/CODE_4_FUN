<?php
     class Printer {    //代理对象,一台打印机
         public function printSth() {
             echo 'I can print <br>';
         }
         
         // some more function below
         // ...
     }
      
     class TextShop {    //这是一个文印处理店,只文印,卖纸,不照相
         private $printer;
         
         public function __construct(Printer $printer) {
             $this->printer = $printer;
         }
         
         public function sellPaper() {    //卖纸
             echo 'give you some paper <br>';
         }
         
         public function __call($method, $args) {    //将代理对象有的功能交给代理对象处理
             if(method_exists($this->printer, $method)) {
                 $this->printer->$method($args);
             }
         }
     }
      
     class PhotoShop {    //这是一个照相店,只文印,拍照,不卖纸
         private $printer;
         
         public function __construct(Printer $printer) {
             $this->printer = $printer;
         }
         
         public function takePhotos() {    //照相
             echo 'take photos for you <br>';
         }
         
         public function __call($method, $args) {    //将代理对象有的功能交给代理对象处理
             if(method_exists($this->printer, $method)) {
                 $this->printer->$method($args);
             }
         }
     }
     
     $printer = new Printer();
     $textShop = new TextShop($printer);
     $photoShop = new PhotoShop($printer);
     
     $textShop->printSth();
     $textShop->sellPaper();
     $photoShop->printSth();
     $photoShop->takePhotos();
 ?>