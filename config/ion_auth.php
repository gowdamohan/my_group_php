<?php
/**
 * Name:    Ion Auth
 * Author:  Ben Edmunds
 *           ben.edmunds@gmail.com
 *           @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization. This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 * @package    CodeIgniter-Ion-Auth
 * @author     Ben Edmunds
 * @link       http://github.com/benedmunds/CodeIgniter-Ion-Auth
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 | -------------------------------------------------------------------------
 | Database group name option.
 | -------------------------------------------------------------------------
 | Allows to select a specific group for the database connection
 |
 | Default is empty: uses default group defined in CI's configuration
 | (see application/config/database.php, $active_group variable)
 */
$config['database_group_name'] = '';

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['users']           = 'users';
$config['tables']['groups']          = 'groups';
$config['tables']['users_groups']    = 'users_groups';
$config['tables']['login_attempts']  = 'login_attempts';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from users.id
 | Joins from groups.id
 */
$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

/*
 | -------------------------------------------------------------------------
 | Hash Method (sha1 or bcrypt)
 | -------------------------------------------------------------------------
 | Bcrypt is available in PHP 5.3+
 |
 | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
 | bcrypt instead of sha1.
 |
 | NOTE: If you use bcrypt you will need to increase your password column character limit to (80)
 |
 | Below there is "default_rounds" setting.  This defines how strong the encryption will be,
 | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
 | this based on your server hardware.
 |
 | If you are using Bcrypt the Admin password field also needs to be changed in order to login as admin:
 | $2y$: $2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa
 | $2a$: $2a$08$6TTcWD1CJ8pzDy.2U3mdi.tpl.nYOR1pwYXwblZdyQd9SL16B7Cqa
 |
 | Be careful how high you set max_rounds, I would do your own testing on how long it takes
 | to encrypt with x rounds.
 |
 | salt_prefix: Used for bcrypt. Versions of PHP before 5.3.7 only support "$2a$" as the salt prefix
 | Versions 5.3.7 or greater should use the default of "$2y$".
 */
$config['hash_method']    = 'bcrypt';	// sha1 or bcrypt, bcrypt is STRONGLY recommended
$config['default_rounds'] = 8;			// This does not apply if random_rounds is set to true
$config['random_rounds']  = FALSE;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;
$config['salt_prefix']    = version_compare(PHP_VERSION, '5.3.7', '<') ? '$2a$' : '$2y$';

/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | maximum_login_attempts: This maximum is not enforced by the library, but is
 | used by $this->ion_auth->is_max_login_attempts_exceeded().
 | The controller should check this function and act
 | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title']                 = "http://gomygroup.com/";       // Site Title, example.com
$config['admin_email']                = "gm.mygroup@gmail.com"; // Admin Email, admin@example.com
$config['default_group']              = 'members';           // Default group, use name
$config['admin_group']                = 'admin';             // Default administrators group, use name
$config['identity']                   = 'username';             // You can use any unique column in your table as identity column. The values in this column, alongside password, will be used for login purposes
$config['min_password_length']        = 6;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = FALSE;               // Email Activation for registration
$config['manual_activation']          = TRUE;               // Manual Activation for registration
$config['manual_activation_client']   = TRUE;                // Manual Activation for registration
$config['remember_users']             = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               // Extend the users cookies every time they auto-login
$config['track_login_attempts']       = TRUE;                // Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address']     = TRUE;                // Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 /* The number of seconds to lockout an account due to exceeded attempts
																You should not use a value below 60 (1 minute) */
$config['forgot_password_expiration'] = 0;                   // The number of seconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.
$config['recheck_timer']              = 0;                   /* The number of seconds after which the session is checked again against database to see if the user still exists and is active.
																Leave 0 if you don't want session recheck. if you really think you need to recheck the session against database, we would
																recommend a higher value, as this would affect performance */

/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 | 	  'file' = Use the default CI config or use from a config file
 | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = true; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
	'mailtype' => 'html',
	'protocol'  => 'smtp',
	'smtp_host' => 'ssl://smtp.zoho.com',
	'smtp_port' => 465, //465
    // 'smtp_user' => 'noreply.mygroup@gmail.com',
	'smtp_user' => 'help.mygroup@zohomail.in',
	'smtp_pass' => 'Shankar@2022',
	'charset'   => 'iso-8859-1',
	'wordwrap'  => TRUE,
	'newline'=>"\r\n"
);

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'auth/email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 22
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</p>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<p>';		// Error message start delimiter
$config['error_end_delimiter']     = '</p>';	// Error message end delimiter
