var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function resetVals(eleId) {
    var len = $(".filter_exp").length;
    for (var i = 0; i < len; i++) {
        var ele = $(".filter_exp").eq(i);
        var l_ele = ele.attr('id');
        if (l_ele != eleId) {
            ele.val("");
        }
    }
    len = $(".filter_exp_sel").length;
    for (var i = 0; i < len; i++) {
        var ele = $(".filter_exp_sel").eq(i);
        var l_ele = ele.attr('id');
        if (l_ele != eleId) {
            ele.val("");
        }
    }

}

$(".one_day").on('click', function () {
    var ele = $(this);
    $.post("data/ajax/get_debits.php", {
        sel_date: ele.attr("data-id")
    }, function (data) {
        $("#day_tb_body").html(data);
    });
});

$("select[name='type']").on('change', function () {
    $("input[name='new_name']").val("");
    $("select[name='new_status']").val("");
    $("select[name='input']").val("");
    $.post("data/ajax/get_cat.php", {
        cb_type: $(this).val()
    }, function (data) {
        $("select[name='category']").html(data);
    });
});

$("select[name='category']").on('change', function () {
    $("input[name='new_name']").val("");
    $("select[name='new_status']").val("");
    $("input[name='new_type']").val("");
    var cb_ = $("select[name='type']").val();
    $.post("data/ajax/get_cat_det.php", {
        cat: $(this).val(),
        cb_type: cb_
    }, function (data) {
        if (data != '0') {
            var cat_data = JSON.parse(data);
            $("input[name='data_id']").val(cat_data["data_id"]);
            $("input[name='new_name']").val(cat_data["name"]);
            $("select[name='new_status']").val(cat_data["status"]);
            $("input[name='new_type']").val(cb_);
        }
    });
});
$(".filter_exp").on('input', function () {
    var ele = $(this);
    resetVals(ele.attr('id'));
    $.post("data/ajax/filter_exp.php", {
        req_field: ele.attr('id'),
        req_val: ele.val()
    }, function (data) {
        $("#data_body").html(data);
    });
});

$(".filter_exp_sel").on('change', function () {
    var ele = $(this);
    resetVals(ele.attr('id'));
    $.post("data/ajax/filter_exp.php", {
        req_field: ele.attr('id'),
        req_val: ele.val()
    }, function (data) {
        $("#data_body").html(data);
    });
});

