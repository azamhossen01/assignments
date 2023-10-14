<?php 

namespace App\Classes;

class Validation {
    private $data;
    private $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function validate($rules) {
        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $singleRule) {
                $ruleName = strtok($singleRule, ':');
                $parameters = strtok('');
                $this->executeRule($field, $ruleName, $parameters);
            }
        }
        return;
    }

    private function executeRule($field, $ruleName, $parameters) {
        $value = $this->data[$field];
        $method = 'validate' . ucfirst($ruleName);

        if (method_exists($this, $method)) {
            $this->$method($field, $value, $parameters);
        }
    }

    private function validateRequired($field, $value, $parameters) {
        if (empty($value)) {
            $this->addError($field, "The $field field is required.");
        }
    }

    private function validateEmail($field, $value, $parameters) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "The $field field must be a valid email address.");
        }
    }

    private function validateMin($field, $value, $parameters) {
        if (strlen($value) < $parameters) {
            $this->addError($field, "The $field field must be at least $parameters characters long.");
        }
    }

    private function validateMax($field, $value, $parameters) {
        if (strlen($value) > $parameters) {
            $this->addError($field, "The $field field may not be greater than $parameters characters.");
        }
    }

    private function addError($field, $message) {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }

    public function errors() {
        return $this->errors;
    }
}


