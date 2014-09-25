<?php
return [
	'adminEmail' => 'admin@newzealandfishing.com',
	'supportEmail' => 'admin@newzealandfishing.com',
	'user.passwordResetTokenExpire' => 3600,
	'businessName' => 'bookaspot',
	'defaultSchema' => 'bookaspot',
	// path to store uploaded files in that are outside document root - copied to privateWebUploadsPath when required
	// and then removed periodically so that they are only available to users with access
	'privatePermanentUploadsPath' => '/Users/Andrew/uploads/',
	// path to store uploaded files inside document root and temporary i.e. privacy is a concern
	'publicTemporaryUploadsPath' => dirname(__FILE__) . '/../../backend/web/assets/uploads/',
	// url for uploaded files temporarily exposed i.e. privacy is a concern
	'webTemporaryUploadsUrl' => '/bookaspot/backend/web/assets/uploads/',
];

