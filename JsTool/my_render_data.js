/**
 * Created by ShiO on 2017/02/17.
 */

// 将json格式的值渲染到模板
function renderData(data, targetTemplateId, beforeRenderDataHandleFun, changeTemplateFun) {
    if(!data) {
        return null;
    }
    var targetTemplateObj = $('#' + targetTemplateId).clone();

    var domStr = '';
    var result = false;
    for (var i = 0; i < data.length; i++) {
        // 改变模板
        if (changeTemplateFun) {
            result = changeTemplateFun(data[i], targetTemplateObj);

            if (result) {
                result = result.clone();
                targetTemplateObj = result;
            }
        }
        if (beforeRenderDataHandleFun) {
            data[i] = beforeRenderDataHandleFun(data[i]);
        }
        domStr += templateRenderData(targetTemplateObj, data[i], null, '{{', '}}');
    }
    return domStr;
}

// 渲染根据指定模板替换模块
function templateRenderData(targetTemplateObj, renderData, mark, leftSplit, rightSplit) {
    //targetTemplateObj.show();
    targetTemplateObj.css('display', 'block');
    targetTemplateObj.removeAttr('id');
    var targetTemplateStr = $(targetTemplateObj)[0].outerHTML;

    // 判断是否是对象，字符串数组属于对象
    if (typeof renderData == 'object') {
        var isDesignatedMarkArr = false;
        // mark为空，单数组转化
        if (mark != null) {
            isDesignatedMarkArr = true;
            // 指定mark组转化
        }
        var i = 0;
        $.each(renderData, function (index, value, array) {
            if (isDesignatedMarkArr) {
                mark = mark[i];
            } else {
                mark = index;
            }
            mark = leftSplit + mark + rightSplit;
            var rxp = new RegExp(mark, 'g');
            targetTemplateStr = targetTemplateStr.replace(rxp, value);
            i++;
        });
    } else {
        var rxp = new RegExp(mark, 'g');
        mark = leftSplit + mark + rightSplit;
        targetTemplateStr = targetTemplateStr.replace(rxp, renderData);
    }
    return targetTemplateStr;
}
