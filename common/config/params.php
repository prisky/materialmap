<?php
return [
	'adminEmail' => 'admin@newzealandfishing.com',
	'supportEmail' => 'admin@newzealandfishing.com',
	'user.passwordResetTokenExpire' => 3600,
	'businessName' => 'bookaspot',
	'defaultSchema' => 'bookaspot',
	// path to store uploaded files inside document root that stay there permanently i.e. privacy no concern
	'publicPermanentUploadsPath' => dirname(__FILE__) . '/uploads',
	// path to store uploaded files inside document root and temporary i.e. privacy is a concern
	'publicTemporayUploadsPath' => dirname(__FILE__) . '/assets/uploads',
	// url for uploaded files privacy is no concern so can remain permantly
	'webPermanentUploadsPath' => '/uploads',
	// url for uploaded files temporarily exposed i.e. privacy is a concern
	'webTemporaryUploadsPath' => '/assets/uploads',
];

