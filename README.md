adsf
<code>
	$user->update ( array ( 'firstname' => 'Ethan' ) );
	$user->chicken = 'egg';
	echo $user->chicken;
	$user->save ();
	echo $user->firstname . ' ' . $user->lastname;
</code>