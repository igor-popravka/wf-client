<?php
namespace DC\WFAPI\GUI;

    /**
     * @author: igor.popravka
     * Date: 11.11.2016
     * Time: 17:09
     */

/**
 * @property string $name
 * @property string $value
 * @property string $type
 * @property string $label
 * @property string $placeholder
 * @property boolean $required
 * @property boolean $disabled
 * @property boolean $hidden
 * @property callable $validate
 * @property array $data
 * @property Command $context
 * @property array $source
 */
class Param {
    const PTYPE_INPUT = 'input';
    const PTYPE_TEXT = 'text';
    const PTYPE_MULTITEXT = 'multitext';
    const PTYPE_COOSE = 'choose';
    const PTYPE_CURRENCY = 'currency';
    const PTYPE_COUNTRIES = 'countries';
    const PTYPE_BOOLEAN = 'boolean';
    const PTYPE_FILE = 'file';
    const PTYPE_INSTANCE = 'instance';
    const PTYPE_APPLICATION = 'application';
    const PTYPE_ENVIRONMENT = 'environment';
    const PTYPE_HIDDEN = 'hidden';
    const PTYPE_BRANCHES = 'branches';
    const PTYPE_THIRD_STATUS = 'third_status';
    const PTYPE_WITHDRAWAL_TYPE = 'withdrawal_type';
    const PTYPE_SKRILL_NETELLER_MATCHES_TYPE = 'skrill_neteller_matches_type';
    const PTYPE_QD_BANK_LIST = 'qd_bank_list';
    const PTYPE_JSON = 'json';
    const PTYPE_PRODUCT_TYPES = 'product_types';
    const PTYPE_LIST = 'list';

    private $name;
    private $value = '';
    private $type = self::PTYPE_TEXT;
    private $label = '';
    private $required = false;
    private $disabled = false;
    private $hidden = false;
    private $validate = null;
    private $data = [];
    private $placeholder = '';
    private $context = null;
    private $source = [];

    public function __construct($name, $context) {
        $this->name = $name;
        $this->context = $context;
    }

    public function toArray() {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'type' => $this->type,
            'label' => $this->label,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'hidden' => $this->hidden,
            'validate' => $this->validate,
            'data' => $this->data,
            'placeholder' => $this->placeholder,
            'source' => $this->source,
        ];
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw Exception::create("Try to get not exist param {$name}");
    }

    public function __set($name, $value) {
        if (!property_exists($this, $name)) {
            throw Exception::create("Try to set not exist param {$name}.");
        } else if ($name == 'name' || $name == 'context') {
            throw Exception::create("You cannot change param {$name}. It's only for read.");
        }
        $this->$name = $value;
    }

    public function render() {
        extract($this->toArray());
        ob_start();
        require DIR_ROOT . "templates/fields/{$this->type}.phtml";
        return ob_get_clean();
    }

    public function validate() {
        $res = Response::instance();
        if (is_callable($this->validate)) {
            call_user_func($this->validate, $this, $res);
        }

        if ($this->required && empty($this->value)) {
            $res->addError("Field \"{$this->name}\" is required and should be filled");
        }
    }

    public function setProperties(array $properties){
        $this->fromArray($properties);
        return $this;
    }

    private function fromArray(array $data){
        foreach ($data as $code => $value){
            $this->__set($code, $value);
        }
    }
}