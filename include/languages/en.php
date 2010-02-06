<?php
/**
 * en.php
 * 
 * English / English Translation of Ninko
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.1
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 * @language English
 */

// Start the array
$lang = Array();
	
	// ** KEYS MUST BE IN CAPITAL LETTERS. ** //
	
	// ** Default Encoding / Direction ** //
		$lang['ENCODING'] 					= 'UTF-8';
		$lang['DIRECTION'] 					= 'ltr';
		
	// ** Redirections ** //
		$lang['REDIRECTING']				= "Now redirecting you to the index..";
		$lang['REDIRECTING_TOPIC']			= "Now redirecting you to the topic..";
		$lang['REDIRECTING_BACK']			= "Now redirecting you back..";
		
	// ** Common ** //
		$lang['HOME']						= "home";
		$lang['HOME_C']						= "Home";
		$lang['MAIN']						= "Main";
		$lang['REGISTRATION']				= "Registration";
		$lang['BY']							= "by";
		$lang['ERROR']						= "error";
		$lang['ERROR_C']					= "Error";
		$lang['ID']							= "id";
		$lang['ID_C']						= "Id";
		$lang['REGISTERED_USERS']			= "Registered users";
		$lang['USERS_ONLINE']				= "Users online";
		$lang['ADMINS_ONLINE']				= "Admins online";
		$lang['NAVIGATION']					= "Navigation";
		
	// ** Plugin ** //
	
		// ** GUESTS PLUGIN ** //
			$lang['GUESTS_ONLINE']			= "Guests online";
			$lang['BOTS_ONLINE']			= "Bots online";
			$lang['NO_ONLINE']				= "No users online";
		
		// ** CAPTCHA ** //
			$lang['CAPTCHA_TITLE']			= "Bot check (What is the answer?)";
			$lang['CAPTCHA_FALSE']			= "Wrong answer for captcha!";

		
	// ** Pagination ** //
		$lang['PAGE']						= "page";
		$lang['PAGES']						= "pages";
		
	// ** Topic Related ** //
		$lang['TOPIC']						= "topic";
		$lang['TOPIC_C']					= "Topic";
		$lang['TOPICS']						= "topics";
		$lang['TOPICS_C']					= "Topics";
		$lang['POST']						= "post";
		$lang['POST_C']						= "Post";
		$lang['POSTS']						= "posts";
		$lang['POSTS_C']					= "Posts";
		$lang['STICKY'] 					= "Sticky";
		$lang['CLOSED'] 					= "Closed";
		$lang['QUICK_REPLY']				= "Quick Reply";
		$lang['REPLY']						= "reply";
		$lang['REPLY_C']					= "Reply";
		$lang['REPLYING_TO']				= "Replying to";
		$lang['EDITING_POST']				= "Editing post";
		$lang['POSTING_NEW_TOPIC']			= "Posting new topic";
		$lang['START_NEW_TOPIC']			= "Start New Topic";
		$lang['NO_TOPICS']					= "No topics to show!";
		$lang['CREATED_ON']					= "Created on";
		$lang['TOPIC_BY']					= "Topic by";
		$lang['JOINED']						= "Joined";
		$lang['EDIT']						= "edit";
		$lang['DELETE']						= "delete";
		$lang['EDIT_C']						= "Edit";
		$lang['DELETE_C']					= "Delete";
		$lang['BAN']						= "ban";
		$lang['BAN_C']						= "Ban";
		$lang['UNBAN']						= "unban";
		$lang['UNBAN_C']					= "Unban";
		$lang['QUICK_QUOTE']				= "quick quote";
		$lang['QUOTE']						= "quote";
		$lang['MESSAGE']					= "Message";
		$lang['USER_FEATURES']				= "User Features";
		$lang['EXTRA_FEATURES']				= "Extra Features";
		$lang['PREVIEW']					= "Preview";
		$lang['STICKY_TOPIC']				= "Stick topic to the top of the forum?";
		$lang['CLOSED_TOPIC']				= "Post topic as closed?";
		$lang['SUBJECT']					= "subject";
		$lang['SUBJECT_C']					= "Subject";
		$lang['LAST_POST']					= "Last post was";
		$lang['NONE']						= "none";
		$lang['STARTER']					= "starter";
		$lang['STARTER_C']					= "Starter";
		
	// ** Admin ** //
		$lang['MANAGE_USERS']				= "Manage Users";
		$lang['MANAGE_TOPICS']				= "Manage Topics";
		$lang['MANAGE_POSTS']				= "Manage Posts";
		$lang['MANAGE_PLUGINS']				= "Manage Plugins";
		$lang['EDITING_USER']				= "Editing User";
		$lang['FORUM_STATISTICS']			= "Forum Statistics";
		$lang['FORUM_SETTINGS']				= "Forum Settings";
		$lang['SITE_SETTINGS']				= "Site Settings";
		$lang['MAIN_SETTINGS']				= "Main Settings";
		$lang['REGISTRATION_SETTINGS']		= "Registration Settings";
		$lang['EMAIL_SETTINGS']				= "Email Settings";
		$lang['USER_SETTINGS']				= "User Settings";
		$lang['AVATAR_SETTINGS']			= "Avatar Settings";
		$lang['TOPIC_SETTINGS']				= "Topic Settings";
		$lang['MESSAGE_SETTINGS']			= "Message Settings";
		$lang['TIME_SETTINGS']				= "Time Settings";
		$lang['ADMIN_WELCOME']				= "Welcome to the ACP. This is the home page that shows your forum statistics.";
		$lang['USER_REGISTRATIONS']			= "User Registrations";
		$lang['TOTAL_TOPICS_POSTS']			= "Total Posts / Topics";
		$lang['TOTAL_USER_REGISTRATIONS']	= "Total User Registrations";
		$lang['STATUS']						= "Status";
		$lang['ACTIONS']					= "Actions";
		$lang['SETTINGS']					= "Settings";
		$lang['BANNED']						= "banned";
		$lang['ADMIN']						= "admin";
		$lang['NEW_PASSWORD']				= "New Password";
		$lang['NEW_PASSWORD_AGAIN']			= "New Password Again";
		$lang['TIMEZONE']					= "Timezone";
		$lang['SITE_NAME']					= "Site name";
		$lang['SITE_URL']					= "Site url";
		$lang['SITE_URL_MSG']				= "No trailing slash, E.g:<br />http://ninko.com/board";
		$lang['TIME_SETTINGS']				= "Time Settings";
		$lang['DATE_FORMAT']				= "Date Format";
		$lang['CURRENTLY']					= "Currently";
		$lang['HELP_FORMATTING']			= "Help on formatting <a href='http://www.php.net/manual/en/function.date.php'>here</a>";
		$lang['COOKIE_SETTINGS']			= "Cookie Settings";
		$lang['ALLOW']						= "Allow";
		$lang['ALLOW_MSG']					= "Allow cookies to be set on login?";
		$lang['COOKIE_DOMAIN']				= "Cookie Domain";
		$lang['COOKIE_DOMAIN_MSG']			= "Your sites domain name, no http:// or trailing slashes e.g, ninko.com or /";
		$lang['AGE_VALIDATION']				= "Age Validation";
		$lang['AGE_VALIDATION_MSG']			= "For no age validation leave blank";
		$lang['USERNAME_LENGTH']			= "Username Length";
		$lang['MIN_MAX']					= "Min - Max";
		$lang['EMAIL_VALIDATION']			= "Email Validation";
		$lang['EMAIL_VALIDATION_MSG']		= "Make users who register validate their email address?";
		$lang['EMAIL_SENDER']				= "Email Sender";
		$lang['EMAIL_SENDER_MSG']			= "Registration email sender";
		$lang['EMAIL_TEMPLATE']				= "Email Template";
		$lang['EMAIL_SUBJECT']				= "Email Subject";
		$lang['TAGS']						= "Tags";
		$lang['EMAIL_MESSAGE']				= "Email Message";
		$lang['ADMIN_SYMBOL']				= "Admin Symbol";
		$lang['ADMIN_SYMBOL_MSG']			= "Character used to show admin status. E.g: !Nijikokun";
		$lang['USER_TIMEOUT']				= "User Online Timeout";
		$lang['IN_SECONDS']					= "in seconds";
		$lang['AVATAR_DIRECTORY']			= "Avatar Upload Directory";
		$lang['AVATAR_DIRECTORY_MSG']		= "Path to upload directory.<br />e.g, avatar/ or /home/public_html/avatar/";
		$lang['AVATAR_DIRECTORY_NAME']		= "Avatar Upload Folder Name";
		$lang['AVATAR_DIRECTORY_NAME_MSG']	= "Name of upload folder<br />e.g, avatar";
		$lang['AVATAR_MAX_SIZE']			= "Avatar Max Filesize";
		$lang['AVATAR_MAX_SIZE_MSG']		= "in KiB";
		$lang['AVATAR_MAX_WIDTHXHEIGHT']	= "Avatar Max Width x Height";
		$lang['WIDTHXHEIGHT']				= "w x h";
		$lang['AVATAR_FILENAME_USE']		= "Avatar Filename Use";
		$lang['AVATAR_FILENAME_USE_MSG']	= "What do we use for the filename?<br />Choices: username, email, id";
		$lang['AVATAR_MD5_USE']				= "Avatar md5 Filename";
		$lang['AVATAR_MD5_USE_MSG']			= "Do you want filenames to be a md5 of the use?";
		$lang['PAGE_OPTIONS']				= "Page Options";
		$lang['BBCODE_OPTIONS']				= "BBCode Options";
		$lang['SHOW_FIRST_POST']			= "Show the first post on every page?";
		$lang['SHOW_QUICK_REPLY']			= "Show quick reply form?";
		$lang['ALLOW_BBCODE']				= "Allow bbcode in posts?";
		$lang['ALLOW_BBCODE_URL']			= "Allow the bbcode [url] tag?";
		$lang['ALLOW_BBCODE_IMG']			= "Allow the bbcode [image] tag?";
		$lang['MESSAGES_PER']				= "Messages Per";
		$lang['TOPICS_PER']					= "topics per index page";
		$lang['POSTS_PER']					= "posts per topic";
		$lang['MESSAGE_LENGTH']				= "Message Length";
		$lang['SECONDS_BETWEEN_TOPICS']		= "seconds between posting topics";
		$lang['SECONDS_BETWEEN_POSTING']	= "seconds between replying to a topic";
		$lang['PLUGIN']						= "plugin";
		$lang['PLUGIN_C']					= "Plugin";
		$lang['ACTIVATE']					= "activate";
		$lang['DEACTIVATE']					= "deactivate";
		$lang['LANGUAGE']					= "language";
		$lang['LANGUAGE_C']					= "Language";
		$lang['SITE_LANGUAGE']				= "Site Language";
		$lang['LANGUAGE_MSG']				= "The language of your preference";
		$lang['SITE_THEME']					= "Site Theme";
		
		
		
	// ** Error / Success ** //
		$lang['ERROR']						= "Error";
		$lang['ERROR_TOPIC_CLOSED']			= "Topic is closed. You are not authorized to post to this topic!";
		$lang['ERROR_DELETING_POSTS']		= "Could not delete posts";
		$lang['ERROR_DELETING_TOPIC']		= "Could not delete that topic";
		$lang['ERROR_DELETING_POST']		= "Could not delete that post";
		$lang['ERROR_TOPIC_MISSING']		= "Topic requested was not found!";
		$lang['ERROR_POST_MISSING']			= "Post requested was not found!";
		$lang['ERROR_NOT_LOGGED']			= "You must be logged in to do that!";
		$lang['ERROR_BANNED']				= "Sorry, you were banned it seems.";
		$lang['ERROR_INVALID_CHARS']		= "%s contains invalid characters!";
		$lang['ERROR_INVALID_GIVEN']		= "Invalid %s given!";
		$lang['ERROR_GIVEN_NOT_NUMERIC']	= "%s given is not numeric!";
		$lang['ERROR_NO_GIVEN']				= "No %s was given!";
		$lang['ERROR_INVALID_USER_PASS']	= "Invalid username / password combination!";
		$lang['ERROR_FLOOD_DETECTION']		= "Flood detection, posting too soon.";
		$lang['ERROR_WITH_COOKIES']			= "Error with cookies";
		$lang['ERROR_COOKIE_BODY']			= "Please <a href='%s'>logout</a>.<br />You will then be asked to sign back in<br /><br /><strong>If logging out does not work:</strong><br />Close your browser and try to log back in."; 
		$lang['ERROR_MESSAGE_LENGTH']		= "Message is either too long or too short. %s maximum characters, %s minimum!";
		$lang['ERROR_USERNAME_TAKEN']		= "Username Taken!";
		$lang['ERROR_USERNAME_TOO_LONG']	= "Username is too long!";
		$lang['ERROR_USERNAME_TOO_SHORT']	= "Username is too short!";
		$lang['ERROR_PASSWORD_TOO_LONG']	= "Password is too long!";
		$lang['ERROR_PASSWORD_TOO_SHORT']	= "Password is too short!";
		$lang['ERROR_PASSWORD_MATCH']		= "Passwords don't match!";
		$lang['ERROR_BANNED_EMAIL']			= "That email has been banned.";
		$lang['ERROR_EMAIL_USED']			= "Email already in use, If you forgot your password please reset it!";
		$lang['ERROR_YEAR_INVALID']			= "Year must be in xxxx, e.g, 1970!";
		$lang['ERROR_YEAR_YOUNG']			= "You must be at least %s years old to join!";
		$lang['ERROR_CURRENT_PASS']			= "Your current password does not match the one on file.";
		$lang['ERROR_NO_FILE']				= "No file given!";
		$lang['ERROR_FILETYPE']				= "The file you selected is the wrong filetype.";
		$lang['ERROR_FILE_SIZE']			= "The file you selected exceeds %s KiB!";
		$lang['ERROR_FILE_WXH']				= "The file you selected exceeds %s x %s!";
		$lang['ERROR_MSN_HANDLE']			= "Msn handle must be an email!";
		$lang['ERROR_USER_DOESNT_EXIST']	= "User does not exist!";
		$lang['ERROR_ALREADY_LOADED'] 		= "Plugin is already active!";
		$lang['ERROR_PLUGIN_NAME']			= "Plugin contains invalid characters in the name!";
		$lang['ERROR_PLUGIN_NO_NAME']		= "Plugin has no name to use!";


		$lang['ERROR_UNKNOWN']				= "Error unknown.";
	
		
		$lang['SUCCESS_DELETED_TOPIC']		= "Successfully deleted topic!";
		$lang['SUCCESS_DELETED_POST']		= "Successfully deleted post!";
		$lang['SUCCESS_EDITED_POST']		= "Successfully edited post!";
		$lang['SUCCESS_EDITED_TOPIC']		= "Successfully edited topic!";
		$lang['SUCCESS_POST']				= "Post added!";
		$lang['SUCCESS_TOPIC']				= "Topic added!";
		$lang['SUCCESS_UPDATE_PASSWORD']	= "Successfully updated password!";
		$lang['SUCCESS_UPDATE_AVATAR']		= "Congratulations, your avatar has been updated!";
		$lang['SUCCESS_UPDATE_PROFILE']		= "Successfully updated profile!";
		$lang['SUCCESS_LOGOUT']				= "Successfully Logged Out";
		$lang['SUCCESS_UPDATED']			= "Successfully updated";
		$lang['SUCCESS_PLUGIN_ACTIVATE']	= "Plugin activated!";
		$lang['SUCCESS_PLUGIN_DEACTIVATE']	= "Plugin de-activated!";
		$lang['SUCCESS_REG_EMAIL_VALIDATE']	= "Please check your mail to activate your account!";
		$lang['SUCCESS_REG_EMAIL_MSG']		= "We sent an activation email to your email address: %s.<br />If you do not get the email make sure to check your spam inbox to make sure. If you still have not yet gotten it within 24 hours please contact an administrator to get help with activating your account.";
			
		
	// ** User Related ** //
		$lang['WELCOME_BACK']				= "Welcome back";
		$lang['USER_CP']					= "User Control Panel";
		$lang['ADMIN_CP']					= "Admin Control Panel";
		$lang['USER_WELCOME']				= "Welcome, this is your control panel. This panel shows you your most recent information, and allows you to edit your account.";
		$lang['USER']						= "user";
		$lang['USER_C']						= "User";
		$lang['LOGIN']						= "login";
		$lang['LOGIN_C']					= "Login";
		$lang['LOGOUT']						= "logout";
		$lang['LOGOUT_C']					= "Logout";
		$lang['REGISTER']					= "register";
		$lang['REGISTER_C']					= "Register";
		$lang['USERNAME']					= "Username";
		$lang['PASSWORD']					= "Password";
		$lang['PASSWORD_AGAIN']				= "Password Again";
		$lang['EMAIL']						= "Email";
		$lang['YEAR']						= "year";
		$lang['YEAR_C']						= "Year";
		$lang['YOUR_CP']					= "Your Control Panel";
		$lang['EDIT_ACCOUNT']				= "Edit Account";
		$lang['EDIT_AVATAR']				= "Edit Avatar";
		$lang['EDIT_PROFILE']				= "Edit Profile";
		$lang['EDIT_SIGNATURE']				= "Edit Signature";
		$lang['FIRST_NAME']					= "First name";
		$lang['LAST_NAME']					= "Last name";
		$lang['AIM']						= "Aim";
		$lang['LOCATION']					= "Location";
		$lang['SEX']						= "Gender";
		$lang['MSN']						= "Live Messenger";
		$lang['INTERESTS']					= "Interests";
		$lang['VIEWING_PROFILE']			= "Viewing Profile of";
		$lang['JOINED']						= "Joined";
		$lang['YOUR_ACTIVITY']				= "Your Activity";
		$lang['LAST_VISIT']					= "Last Visit";
		$lang['LAST_VISIT_MSG']				= "The time of your last visit";
		$lang['EDITING_ACCOUNT_MSG']		= "You are editing your account. Please be careful!";
		$lang['EDITING_ACCOUNT']			= "Editing Account";
		$lang['TOTAL_POSTS']				= "Total Posts";
		$lang['TOTAL_POSTS_MSG']			= "A count of all your posts";
		$lang['LAST_POST']					= "Last Post";
		$lang['LAST_POST_MSG']				= "The last post you made.";
		$lang['REGISTER_FOR']				= "Registering for";
		$lang['REGISTER_USERNAME']			= "Username (No special characters! a-z, 0-9, and underscores only.)";
		$lang['BIRTHDAY']					= "Birthday";
		$lang['AGREEMENT_TITLE']			= "Registration Agreement Terms";
		$lang['AGREEMENT_TERMS']			= "While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions."; 
		$lang['CURRENT_AVATAR']				= "Current Avatar";
		$lang['AVATAR_UPLOAD_LIMITS']		= "Maximum dimensions: %sw x %sh<br />File Size: %skb<br />Accepted Filetypes: jpg, png, gif";
		$lang['EDITING_AVATAR']				= "Editing Avatar";
		$lang['UPLOAD_FROM_COMPUTER']		= "Upload from computer";
		$lang['CONFIRM_CURRENT_PASSWORD']	= "To make any changes to your account you must confirm your current password";
		$lang['NO_AVATAR']					= "No avatar";
		$lang['CHANGE_USERNAME_DISALLOWED']	= "Changing of the username is not allowed!";
		$lang['CURRENT_PASSWORD']			= "Current Password";
		$lang['KEY']						= "key";
		$lang['KEY_C']						= "Key";
		$lang['ACCOUNT_VERIFIED']			= "Account has been verified!";
		
		
	// ** NICE DATE RELATED ** //
		$lang['TOMORROW']					= "Tomorrow";
		$lang['TODAY']						= "Today";
		$lang['YESTERDAY']					= "Yesterday";
		$lang['NEXT']						= "Next";
		$lang['LAST']						= "Last";
		$lang['WEEK']						= "Week";
		$lang['MONTH']						= "Month";
?>