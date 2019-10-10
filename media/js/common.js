$(function () {
    var modalBox = $(
        '<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">\
            <div class="modal-dialog modal-sm">\
                <div class="modal-content">\
                    Running Command . . .\
                </div>\
            </div>\
        </div>'
    );
    var _files;

    function request(data, response) {
        $.ajax({
            type: "POST",
            url: location.href,
            dataType: "json",
            data: data,
            success: response
        });
    }

    function upload(data, params, response) {
        $.ajax({
            url: location.href + '&' + params,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: response
        });
    }

    $('a.test-case-item').click(function (e) {
        var form = $('#api-form');
        $('input[name="case_id"]', form).val($(this).data('key'));
        form.submit();
    });

    $('.submit').click(function (e) {
        modalBox.modal('show');
        e.preventDefault();

        $('#tester_action').val('run');

        var response = function (rsp) {
            $('#info-panel').html('');
            if (rsp.status == 'OK') {
                $('#formatted').html(rsp.formatted);
                $('#raw').html('<pre>' + rsp.raw + '</pre>');
            } else {
                $(rsp.errors).each(function (i, m) {
                    $('<h4 class="bg-danger error-message">').html(m).appendTo('#info-panel');
                });
            }

            $('#tester_action').val('view');
            modalBox.modal('hide');
        };

        if (!_files) {
            request($('#api-form').serialize(), response);
        } else {
            var data = new FormData();
            $.each(_files, function (key, value) {
                data.append(key, value);
            });

            upload(data, $('#api-form').serialize(), response);
        }

        return false;
    });

    $('.nav-tabs li').click(function () {
        $('li', $(this).closest('ul')).each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

        $('.response-data').each(function () {
            $(this).addClass('hidden');
        });
        $('#' + $(this).attr('for')).removeClass('hidden');
    });

    $('input[type="checkbox"]').click(function () {
        var val = $(this).is(':checked') ? 1 : 0;
        $(this).val(val);
    });

    $('input[type=file]').change(function () {
        _files = this.files;
    });

});
