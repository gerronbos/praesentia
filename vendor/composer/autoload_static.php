<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd537467c5ba460042f21d53039c1010
{
    public static $files = array (
        'f0d13a1096dbff25621cdcc0b6a264c7' => __DIR__ . '/../..' . '/helpers/truefalse.php',
        'ff7206b2ed78fb61c86a09a256ed2607' => __DIR__ . '/../..' . '/helpers/time_ago.php',
        'a63b38e360051a6d33db9069ff8160a5' => __DIR__ . '/../..' . '/helpers/progressbar.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mikehaertl\\wkhtmlto\\' => 20,
            'mikehaertl\\tmp\\' => 15,
            'mikehaertl\\shellcommand\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mikehaertl\\wkhtmlto\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/phpwkhtmltopdf/src',
        ),
        'mikehaertl\\tmp\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-tmpfile/src',
        ),
        'mikehaertl\\shellcommand\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-shellcommand/src',
        ),
    );

    public static $classMap = array (
        'Auth' => __DIR__ . '/../..' . '/services/auth.php',
        'ConfigRepositorie' => __DIR__ . '/../..' . '/repositories/ConfigRepositorie.php',
        'CourseRepositorie' => __DIR__ . '/../..' . '/repositories/CourseRepository.php',
        'EasyPeasyICS' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/EasyPeasyICS.php',
        'FormRepositorie' => __DIR__ . '/../..' . '/repositories/FormRepositorie.php',
        'GroupRepository' => __DIR__ . '/../..' . '/repositories/GroupRepository.php',
        'LectureRepository' => __DIR__ . '/../..' . '/repositories/LectureRepository.php',
        'MapStructureRepositorie' => __DIR__ . '/../..' . '/repositories/MapStructureRepositorie.php',
        'NotificationRepository' => __DIR__ . '/../..' . '/repositories/NotificationRepository.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'PresenceRepository' => __DIR__ . '/../..' . '/repositories/PresenceRepository.php',
        'Repository' => __DIR__ . '/../..' . '/repositories/repository.php',
        'RoleRepository' => __DIR__ . '/../..' . '/repositories/RoleRepository.php',
        'RoomRepository' => __DIR__ . '/../..' . '/repositories/RoomRepository.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'Services\\Mail' => __DIR__ . '/../..' . '/services/mail.php',
        'Services\\SessionHandler' => __DIR__ . '/../..' . '/services/sessionhandler.php',
        'UserRepositorie' => __DIR__ . '/../..' . '/repositories/UserRepositorie.php',
        'model\\Course' => __DIR__ . '/../..' . '/model/Course.php',
        'model\\Group' => __DIR__ . '/../..' . '/model/Group.php',
        'model\\Group_has_users' => __DIR__ . '/../..' . '/model/Group_has_users.php',
        'model\\Lecture' => __DIR__ . '/../..' . '/model/Lecture.php',
        'model\\Lecture_has_groups' => __DIR__ . '/../..' . '/model/Lecture_has_groups.php',
        'model\\Notifications' => __DIR__ . '/../..' . '/model/Notifications.php',
        'model\\Presence' => __DIR__ . '/../..' . '/model/Presence.php',
        'model\\Role' => __DIR__ . '/../..' . '/model/Role.php',
        'model\\Room' => __DIR__ . '/../..' . '/model/Room.php',
        'model\\UserRoles' => __DIR__ . '/../..' . '/model/UserRoles.php',
        'model\\User_password_reset' => __DIR__ . '/../..' . '/model/User_password_reset.php',
        'model\\Users' => __DIR__ . '/../..' . '/model/Users.php',
        'model\\model' => __DIR__ . '/../..' . '/model/model.php',
        'ntlm_sasl_client_class' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/ntlm_sasl_client.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd537467c5ba460042f21d53039c1010::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd537467c5ba460042f21d53039c1010::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcd537467c5ba460042f21d53039c1010::$classMap;

        }, null, ClassLoader::class);
    }
}
