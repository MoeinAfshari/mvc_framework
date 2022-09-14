<?php

namespace moeinafshari\phpmvc\form;

use moeinafshari\phpmvc\Model;

abstract class BaseField
{

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct($model, $attribute, $type = "")
    {

        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    abstract public function renderInput() : string;

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
}