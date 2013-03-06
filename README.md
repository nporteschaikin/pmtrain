<code>
	$user = User::create ( array ( 'firstname' => 'Noah', 'lastname' => 'Portes Chaikin' ) );
	
	$user->update ( array ( 'firstname' => 'Ethan' ) );
	
	$user->chicken = 'egg';
	
	echo $user->chicken;
	
	$user->save ();
	
	echo $user->firstname . ' ' . $user->lastname;
	
</code>