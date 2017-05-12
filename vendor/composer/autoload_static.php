<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd537467c5ba460042f21d53039c1010
{
    public static $files = array (
        'f0d13a1096dbff25621cdcc0b6a264c7' => __DIR__ . '/../..' . '/helpers/truefalse.php',
    );

    public static $classMap = array (
        'Auth' => __DIR__ . '/../..' . '/services/auth.php',
        'ConfigRepositorie' => __DIR__ . '/../..' . '/repositories/ConfigRepositorie.php',
        'FormRepositorie' => __DIR__ . '/../..' . '/repositories/FormRepositorie.php',
        'LectureRepository' => __DIR__ . '/../..' . '/repositories/LectureRepository.php',
        'MapStructureRepositorie' => __DIR__ . '/../..' . '/repositories/MapStructureRepositorie.php',
        'NotificationRepository' => __DIR__ . '/../..' . '/repositories/NotificationRepository.php',
        'PresenceRepository' => __DIR__ . '/../..' . '/repositories/PresenceRepository.php',
        'Repository' => __DIR__ . '/../..' . '/repositories/repository.php',
        'Services\\SessionHandler' => __DIR__ . '/../..' . '/services/sessionhandler.php',
        'UserRepositorie' => __DIR__ . '/../..' . '/repositories/UserRepositorie.php',
        'model\\Course' => __DIR__ . '/../..' . '/model/Course.php',
        'model\\Group' => __DIR__ . '/../..' . '/model/Group.php',
        'model\\Lecture' => __DIR__ . '/../..' . '/model/Lecture.php',
        'model\\Notifications' => __DIR__ . '/../..' . '/model/Notifications.php',
        'model\\Presence' => __DIR__ . '/../..' . '/model/Presence.php',
        'model\\Role' => __DIR__ . '/../..' . '/model/Role.php',
        'model\\Room' => __DIR__ . '/../..' . '/model/Room.php',
        'model\\Users' => __DIR__ . '/../..' . '/model/Users.php',
        'model\\model' => __DIR__ . '/../..' . '/model/model.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitcd537467c5ba460042f21d53039c1010::$classMap;

        }, null, ClassLoader::class);
    }
}
