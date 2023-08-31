$(function () {
    $('input.print').on('click', function () {
        if ($.inArray(DEVICE, ['windows', 'mac', 'windowsWechat', 'macWechat']) !== -1) {
            if (confirm('点击确定后，在弹出的打印窗口进行预览，如果超出12页，请在打印窗口中自行设置页边距！')) {
                $('div.print').print({});
            }
        } else {
            alert('请使用电脑进行打印！');
        }
    });
    layui.use(['form'], function () {
        layui.form.on('select(year)', function (data) {
            window.location.href = '?year=' + data.value;
        });
    });
});