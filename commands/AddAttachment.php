<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('addAttachment');
$this->setAPIParamsMode($this::PARAMS_AS_VALUES);

$this->setResponseTemplate($this::RESPONSE_TEMP_PREFORMAT);

$this->createParam('workflow_id')->required = true;

$file_name = $this->createParam('file_name');
$file_name->required = true;
$file_name->type = $file_name::PTYPE_FILE;
$file_name->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (count($_FILES)) {
        $field->value = $_FILES[0]['name'];

        $content = file_get_contents($_FILES[0]['tmp_name']);

        $context = $field->context;
        $field_data = $context->getParam('data', $context::SECTION_CUSTOM_DATA);
        $field_data->value = base64_encode($content);
    } else {
        $response->addError("Failed to upload file");
    }
};

$comments = $this->createParam('comments');
$comments->type = $comments::PTYPE_MULTITEXT;

$data = $this->createParam('data');
$data->type = $data::PTYPE_HIDDEN;