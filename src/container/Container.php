<?php
namespace Container;

class Container
{

    public $binds;

    public $instances;

    //绑定，闭包函数是在make（调用的时候）才实例化的
    public function bind($abstract, $concrete)
    {
       if($concrete instanceof \Closure)
       {
           $this->binds[$abstract] = $concrete;
       } else{
           $this->instances[$abstract] = $concrete;
       }
    }


    //实例化
    public function make($abstract, $parameters = [])
    {
       //判断实例
        if(isset($this->instances[$abstract]))
        {
            return $this->instances[$abstract];
        }

        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}