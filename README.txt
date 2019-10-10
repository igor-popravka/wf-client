===========================================================
---------------------- WF API Tester ----------------------
Author: igor.popravka
Created: 09.08.2016
Version: 1.0.2
-----------------------------------------------------------
===========================================================

1. Configuration tester config.ini.
    1.1 Section [COMMANDS] contains list of commands.

        [COMMANDS]
        Example1 = 'Example Case1';
        Example2 = 'Example Case2';
        ... ;

        Where:
            Example1 - Command ID used for prepare url http://wfapi/Test/Example1,
            'Example Case1' - Description used for prepare commands menu list of page

-----------------------------------------------------------

    1.2 Section [RESPONSE] contains configuration for Response object:

        [RESPONSE]
        base_url = 'http://corelib/DC/Workflow/API/Test';
        base_template = 'templates/index.phtml';

        Where:
            base_url- url path for root folder of Tester,
            base_template - relative path for base template file

===========================================================
===========================================================

2. How to make new WF Tester command.
    2.1. Create a new php script in the 'command' folder (see 'command/Example.php').
    Name of script should be as name future your command. The script should returns array with configurations keys of command.

        REQUIRED KEYS:
            'name' - Displays in tester page header,
            'description' - Displays under tester page header,
            'api_class' - WF API class name,
            'api_method' - WF API method name,
            'parameters' - Input parameters of WF API method and some configuration for fields

        OPTIONAL KEYS:
            'parameters_as_object' (default TRUE) - if TRUE parameters will be passed as object in WF API method. If FALSE - as simple parameters
            'response_template' (default 'response.table') - this template will be rendered response data before out

        KEY PARAMETERS:
            array((string) 'field_name'=> (array) 'options'), where:

            'field_name' - field name of form and parameter name of WF API method,
            'options' - field options of form. It can content next keys:

                'type' (string) - field type one of (text, hidden, date, checkbox, radio, password, file, select, textarea),
                'value' (mixed) - field value,
                'label' (string) - field label,
                'required' (boolean) - if TRUE then label mark "*" and add check rule,
                'display' (boolean) - if TRUE then field will be display,
                'disabled' (boolean) - if TRUE then field will be disabled,
                'list' (array) - only for field with type 'select' --- source for generate <option></option>,
                'validate' (array|callable) - handler/s of validation field. It gets 2 parameters: $name (field name), $value (field value).
                                              Should return error message if field not valid or TRUE if It valid.

    2.2. Add command name and description in the [COMMANDS] section of configuration file (see 1.1).

===========================================================
===========================================================

3. How to make new Test Case for command.
    3.1. Create new json file in the 'cases' folder (see 'cases/example.case.json'). Name of json file is free.

        REQUIRED KEYS:

            'test_case_name' - name of test case, displays in Test Cases list of Request Panel,
            'test_case_description' - name of test case, displays under test case name,
            'command_id' - command id defines in [COMMANDS] section of configuration file
            'options' - fields of group 'Options' of Request Panel
            'fields'- fields of group 'Fields' of Request Panel

        EXAMPLE:
            {
                "test_case_name": "Some Case Name",
                "test_case_description": "Some Case Descriptions",
                "command_id": "Example",
                "options":{
                    "instance": "pre_gva",
                    "application": "EBANK",
                    "environment": "Pre DEMO"
                },
                "fields":{
                    "account": "1021153",
                    "sub_account": "0203USD",
                    "amount" : "20",
                    "currency" : "USD",
                    "description" : "Example Case Data"
                }
            }
