
</div>
<script src="js/app.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/main.js"></script>
<script>
    function displayInTwoDigit(num) {
        return num.toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    }
    function getNowTime() {
        var d = new Date();
        return displayInTwoDigit(d.getHours()) + ":" + displayInTwoDigit(d.getMinutes()) + ":" + displayInTwoDigit(d.getSeconds());
    }

    function real_time(eleId = "bill_time") {
        document.getElementById(eleId).innerHTML = getNowTime();
        setTimeout(real_time, 1000);
    }

    real_time();

    function ch_ele(dataId, dataSetId) {
        $("#" + dataSetId + dataId).show();
        $("#" + dataSetId + "_cdata_" + dataId).hide();
    }
    function hide_ele(dataId, dataSetId, refreshIt = 0) {
        var data_ele = $("#" + dataSetId + "_newData_" + dataId);
        $("#" + dataSetId + dataId).hide();
        $("#" + dataSetId + "_cdata_" + dataId).show();

        $.post("data/ajax/update_cb.php", {
            data_des: dataSetId,
            new_data: data_ele.val(),
            new_dt_type: data_ele.attr("data-id"),
            dta_id: dataId
        }, function (data) {
            if (refreshIt > 0) {
                window.location.reload();
            } else {
                $("#" + dataSetId + "_cdata_" + dataId).html(data_ele.val());
            }
        });
    }

    $(".ch_range").on('change', function () {
        var ch_ele = $(this);
        $("#" + ch_ele.attr('id') + "_val").html(ch_ele.val());
        var sp_ele = $(".ch_tot_det");
        var len = sp_ele.length;
        var tot = 0;
        var sp_tem;
        for (var index = 0; index < len; index++) {
            sp_tem = parseFloat(sp_ele.eq(index).html());
            if (!isNaN(sp_tem)) {
                tot += sp_tem;
            }
        }
        $("#tot_charge").val(tot.toFixed(2));
        var can_pay = parseFloat($("#can_pay").val());
        if (!isNaN(can_pay)) {
            var bal = can_pay - tot;
        }
        $("#balance").val(bal.toFixed(2));

    });
</script>