<?php
session_start();
if (!isset($_SESSION['projects'])) {
    $_SESSION['projects'] = [
        [
            'code' => '1',
            'author' => 'auth1',
            'budget' => 10000,
            'ratings' => [6, 4, 5]
        ],
        [
            'code' => '2',
            'author' => 'auth2',
            'budget' => 15000,
            'ratings' => [7, 8, 5]
        ],
        [
            'code' => '3',
            'author' => 'auth3',
            'budget' => 8000,
            'ratings' => [4, 2, 5]
        ],
        [
            'code' => '4',
            'author' => 'auth4',
            'budget' => 12000,
            'ratings' => [5, 9, 2]
        ],
        [
            'code' => '5',
            'author' => 'auth5',
            'budget' => 20000,
            'ratings' => [9, 6, 5]
        ]
    ];
}

$projects = &$_SESSION['projects'];
?>