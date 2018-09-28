/**
 * Created by ShiO on 2017/02/17.
 */
// 分页索取函数
function pageSend(url, requestPageNum, sendAfterHandleFun, finalPageHandleFun, pageParam) {
    var param = {p: requestPageNum};

    if (pageParam) {
        param = $.extend(param, pageParam);
        console.log(param);
    }

    $.ajax({
        type: "GET",
        url: url,
        data: param,
        dataType: "json",
        success: function (data) {
            // 如果是最后一页就停止加载
            if (!data.page.totalPages || data.page.totalPages == 'null') {
                data.page.totalPages = 1;
            }
            if (data.page.nowPage == data.page.totalPages) {
                // 如果没有更多数据加载,停止加载
                finalPageHandleFun && finalPageHandleFun();
            }
            sendAfterHandleFun && sendAfterHandleFun(data.data, requestPageNum);
        }

    });
}
