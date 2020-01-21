<?php
    namespace Composer;

    class ClassLoader{

        public $vendorDir;

        public $baseDir;

        public $filearr;

        public function __construct()
        {
            $this->vendorDir = dirname(dirname(__FILE__));
            $this->baseDir = dirname($this->vendorDir);
            $this->filearr = [
                            'Otherfunc\Excelfunc' => $this->vendorDir . '/otherfuncs/Excelfunc.php',
                            'Keyboardsfunc\Board' => $this->vendorDir . '/keyboardsfunc/Board.php',
                            'Keyboardsfunc\CommonBoard' => $this->vendorDir . '/keyboardsfunc/CommonBoard.php',
                            'Keyboardsfunc\MechanicalKeyboard' => $this->vendorDir . '/keyboardsfunc/MechanicalKeyboard.php',
                            'Laravel\Application' => $this->vendorDir . '/laravel/Application.php',
                            ];
        }

        public function register()
        {
            spl_autoload_register([$this,'loadclass']);

        }

        public function loadclass($class)
        {
            if ($file = $this->findFile($class)) {
                $this->includeFile($file);
                return true;
            }
        }

        public function findFile($class)
        {
            return $this->filearr[$class];
        }

        function includeFile($file)
        {
            include $file;
        }
        
    }

    // When using spl_autoload_register() with class methods, it might seem that it can use only public methods, though it can use private/protected methods as well, if registered from inside the class:
        
    // class ClassAutoloader {
    //     public function __construct() {
    //         spl_autoload_register(array($this, 'loader'));
    //     }
    //     private function loader($className) {
    //         echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
    //         include $className . '.php';
    //     }
    // }

    // $autoloader = new ClassAutoloader();

    // $obj = new Class1();
    // $obj = new Class2();
     
        