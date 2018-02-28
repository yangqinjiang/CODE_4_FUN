<?php
/**
*php中foreach使用&引用后的异常分析及处理办法
* http://blog.csdn.net/marswill/article/details/79390177
*/
    public function test2()
    {
        $exp = [
            [
                'name' => 'test1',
                'age' => 15,
                'extension' => 'a:3:{s:4:"nose";s:4:"long";s:5:"mouth";s:3:"big";s:3:"eye";s:5:"small";}'
            ],
            [
                'name' => 'test2',
                'age' => 25,
                'extension' => 'a:3:{s:4:"nose";s:5:"long2";s:5:"mouth";s:4:"big2";s:3:"eye";s:6:"small2";}'
            ],
            [
                'name' => 'test4',
                'age' => 18,
                'extension' => 'a:3:{s:4:"nose";s:5:"long2";s:5:"mouth";s:4:"big2";s:3:"eye";s:6:"small2";}'
            ],
            [
                'name' => 'test3',
                'age' => 20,
                'extension' => 'a:3:{s:4:"nose";s:5:"long3";s:5:"mouth";s:4:"big3";s:3:"eye";s:6:"small3";}'
            ],
        ];

//        var_dump($exp);
        foreach ($exp as &$v) {
            $extension = @unserialize($v['extension']);
            // php7
//            $v['nose'] = $extension['nose'] ?? "";
//            $v['mouth'] = $extension['mouth'] ?? "";
//            $v['eye'] = $extension['eye'] ?? "";

            $v['nose'] = isset($extension['nose']) ? $extension['nose'] : "";
            $v['mouth'] = isset($extension['mouth']) ? $extension['mouth'] : "";
            $v['eye'] = isset($extension['eye']) ? $extension['eye'] : "";
//            var_dump($exp);
//            var_dump('-------');
        }

        var_dump('==============');
        var_dump($exp);
        var_dump($v);
        var_dump('******************');
        $newExp = [];
        foreach ($exp as $vv) {// 使用$v 就出现问题

            if ($vv['mouth'] == "big3"){
                $newExp[] = $vv;
            }
            var_dump('++++++++++++++');
            var_dump($vv);
            var_dump($exp);
        }
        dump($newExp);
        /**
         * output:
        *array (size=1)
          0 => 
            array (size=6)
              'name' => string 'test3' (length=5)
              'age' => int 20
              'extension' => string 'a:3:{s:4:"nose";s:5:"long3";s:5:"mouth";s:4:"big3";s:3:"eye";s:6:"small3";}' (length=75)
              'nose' => string 'long3' (length=5)
              'mouth' => string 'big3' (length=4)
              'eye' => string 'small3' (length=6)
        */
        exit;
    }
