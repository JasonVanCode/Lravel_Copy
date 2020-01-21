<?php
    namespace Composer;
    use Otherfunc\Excelfunc;

    class Autoload{

        private static $loader;

        static public function loadClassLoader($class)
        {
            if($class == 'Composer\ClassLoader'){
                require_once __DIR__.'\ClassLoader.php';
            }
            
        }

        public function getautoload()
        {
            // if(self::$loader === null){
            //     return self::$loader;
            // }
            spl_autoload_register(['Composer\Autoload','loadClassLoader']);
            //这边new的时候不能 new Composer\ClassLoader() 在触发loadClassLoader 时候获取的参数是Composer\Composer\ClassLoader
            self::$loader = $loader = new ClassLoader();

            spl_autoload_unregister(['Composer\Autoload','loadClassLoader']);

            $loader->register();

        }


    }

    $a = new Autoload();
    $a->getautoload();