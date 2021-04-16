<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
	</head>
	<body style='font-family:Arial;'>
		Hello, your friend {{session('name')}} invited you to try the task and event app
		<table width='100%' style='font-family:Arial; margin-top:10px; font-size:14px;'>
			<tr><td><a href="{{$playStoreLink}}">click here to enter the task application via browser</a></td></tr>
			<tr><td><a href="{{$websiteLink}}">click here to download the app for Android devices on the Google Play Store</a></td></tr>
		</table>
	</body>
</html>