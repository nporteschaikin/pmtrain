<?php

require ( 'app/load.php' );


// $user = User::create(array('firstname' => 'Noah', 'lastname' => 'Portes Chaikin'));
// $user->address = "109 North 5th St, #3, Brooklyn, NY 11211";
// $user->save();

$user = User::find(1);
echo $user->firstname;