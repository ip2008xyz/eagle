<?php



$di->getShared('dispatcher')->getEventsManager()->attach("dispatch:beforeDispatchLoop", function ($event, $dispatcher) use ($di) {

    //var_dump(__LINE__);exit();
});

