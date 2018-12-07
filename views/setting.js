layui.use(['jquery', 'wulaui'], function ($) {
    $('#default_uploader').change(function () {
        var id = $(this).val();
        $('#params').val(uploaderHints[id].replace(/&/g, "\n"));
    });
    $('#setting-form').removeClass('hidden');
});