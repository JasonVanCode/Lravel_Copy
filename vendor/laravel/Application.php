<?php
    //下面是容器
    namespace Laravel;

    class Application
    {
        protected $binds;

        protected $instances;

        public function bind($abstract, $concrete)
        {
            $this->binds[$abstract]['concrete'] = function ($app) use ($concrete){
                return $app->build($concrete);
            };
        }

        public function make($abstract)
        {
            $concrete = $this->binds[$abstract]['concrete'];
             return $concrete($this);
        }
        
        public function build($concrete)
        {
            $reflector = new \ReflectionClass($concrete);
            $constructor = $reflector->getConstructor();
            if(is_null($constructor)) {
                return $reflector->newInstance();
            }else {
                $dependencies = $constructor->getParameters();
                if($dependencies){
                    $instances = $this->getDependencies($dependencies);
                    return $reflector->newInstanceArgs($instances);
                }else{
                    return $reflector->newInstance();
                }
            }
        }

        protected function getDependencies($paramters) {
            $dependencies = [];
            foreach ($paramters as $paramter) {
                $dependencies[] = $this->make($paramter->getClass()->name);
            }
            return $dependencies;
        }

    }

