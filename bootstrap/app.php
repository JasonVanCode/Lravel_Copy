<?php

    $app = new Laravel\Application();

    $app->bind('Board','Keyboardsfunc\MechanicalKeyboard');

    $board = $app->make('Board');
    var_dump($board->type());die;
