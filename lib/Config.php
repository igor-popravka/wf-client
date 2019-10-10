<?php
namespace DC\WFAPI\GUI;

class Config {
    const SECTION_SESSION = 'SESSION';
    const SECTION_INSTANCES = 'INSTANCES';
    const SECTION_API_KEYS = 'API_KEYS';
    const SECTION_ENVIRONMENTS = 'ENVIRONMENTS';
    const SECTION_COMMANDS = 'COMMANDS';
    const SECTION_GENERAL = 'GENERAL';

    private static $data = [
        self::SECTION_COMMANDS => [],
        self::SECTION_GENERAL => [],
        self::SECTION_SESSION => [],
        self::SECTION_INSTANCES => [],
        self::SECTION_API_KEYS => [],
        self::SECTION_ENVIRONMENTS => []
    ];

    public static function registerItem($name, $value, $section = self::SECTION_GENERAL) {
        self::$data[$section][$name] = $value;
    }

    public static function getItem($name, $section = self::SECTION_GENERAL) {
        return isset(self::$data[$section][$name]) ? self::$data[$section][$name] : null;
    }

    public static function registerSection($section = self::SECTION_GENERAL, array $value = []) {
        self::$data[$section] = $value;
    }

    public static function getSection($section = self::SECTION_GENERAL) {
        return self::$data[$section];
    }

    /**
     * @param string $name
     * @param string $title header of command page default as name
     * @param string $description displays under the {$title}
     * @param string $cases_file path to cases file
     */
    public static function registerCommand($name, $title = '', $description = '', $cases_file = '') {
        self::registerItem(
            $name,
            [
                'name' => $name,
                'title' => empty($title) ? $name : $title,
                'description' => $description,
                'cases_file' => $cases_file
            ],
            self::SECTION_COMMANDS
        );
    }

    public static function getAllCommands() {
        return self::getSection(self::SECTION_COMMANDS);
    }

    public static function getCommand($name) {
        return self::getItem($name, self::SECTION_COMMANDS);
    }
}