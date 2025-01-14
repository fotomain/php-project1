<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;


class Validator
{
    private array $rules=[];
    public function add(string $alias, RuleInterface $rule): void
    {
        $this->rules[$alias]=$rule;
    }
    public function validate(array $formData, array $fields) : void
    {
        $errors=[];
//        dd($formData);
        foreach ($fields as $fieldName => $rules) {
            foreach ($rules as $rule) {
                $ruleValidator = $this->rules[$rule];
                if($ruleValidator->validate($formData, $fieldName, [])) {
                    continue;
                }

//                echo "Error";
                $errors[$fieldName][]=$ruleValidator->getMessage(
                    $formData, $fieldName, []
                );

            }
        }

        if(count($errors)>0) {

            $referer = $_SERVER['HTTP_REFERER'];
            $_SESSION['errors']=$errors;
            redirectTo($referer);

//            redirectTo("/register");
//
//            echo "Ērrors";
//            dd($errors);

//            new ValidationException($errors);

        }

    }

}