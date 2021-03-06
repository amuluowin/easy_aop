--TEST--
EasyAop::add_advice test : namespace
--SKIPIF--
<?php
if (!extension_loaded('easy_aop')) {
    echo 'skip';
}
?>
--FILE--
<?php
namespace A {
    class Test
    {
        public function f()
        {
            echo 'Test::f called' . PHP_EOL;
        }
    }
}

namespace B {
    \EasyAop::add_advice([
        'after@A\Test::f',
    ], function($joinpoint, $args, $ret) {
        echo "after@Test::f called" . PHP_EOL;
    });

    $t = new \A\Test();
    $t->f();
}

?>
--EXPECT--
Test::f called
after@Test::f called