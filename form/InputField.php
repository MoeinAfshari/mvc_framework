<?php

namespace app\core\form;

use app\core\Model;
use JetBrains\PhpStorm\Pure;

class InputField extends BaseField
{
//    public const  TYPE_TEXT = 'text';
//    public const TYPE_PASSWORD = 'password';
//    public const TYPE_NUMBER = 'number';

    public function __construct(Model $model,string $attribute,string $type = "text")
    {
        parent::__construct($model, $attribute, $type);
    }

    public function __toString()
    {
        return sprintf('
        <div class="form-group mb-3">
            <label class="form-label">%s</label>
            %s
            <div class="invalid-feedback">
                %s
            </div>
        </div>
        ',  $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : ''
            );
    }
}