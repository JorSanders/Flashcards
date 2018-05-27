$(document).ready(function () {
    $(".target").change(function () {
        var ulr = 'https://translate.google.com/?text=undefined&hl=en&langpair=auto%7Czh-CN&tbb=1&ie=undefined#auto/zh-CN/undefined';
        $.ajax({
            url: ulr, success: function (result) {
                var $response = $(result);
                dataToday = $response.find('#gt-res-dir-ctr').text();
                dataToday += $response.find('#res-translit').text();
                $("#div1").html(dataToday);
            }
        });
    });
});