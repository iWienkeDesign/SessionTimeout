<!--This should go in your filters.php in the App::before area-->

//    Check to make sure the User is Logged In
if (Auth::user()) {
//        If they are, create a new instance of the DateTime Class
$now = new DateTime();
//        Get the Users Last Actvity Timestamp from the Database
$last_activity1 = Auth::user()->last_activity;
//       Take that Timestamp and pass it through to create a new DateTime Instance with that timestamp
$last_activity = new DateTime($last_activity1);
//        Now calculate the difference of those to instances of the DateTime class
$diff = date_diff($now,$last_activity);
//        Take the difference and reformat it into minutes
$diff = $diff->format('%i');
//   Set your timeout, **TODO Improvements would be to call the Session Timeout
$timeout = "30";
//        Now take the difference and if it is greater than your session timeout then log them out and redirect them to the
//        login in page and send them a message saying Session timedout
if ($diff > $timeout) {
Auth::logout();
return Redirect::to('/login')->with('message', 'Session timed out, please login again.');
}

// If Timeout has not occurred, update last_activity
$user = Auth::user();
$user->last_activity = $now;
$user->save();


}