/**
 * Created by ShiO on 2017/02/17.
 */
// 工具函数，时间戳转时间
function formatStamp2Date(now, formatStyleFun) {
    now = new Date(now * 1000);
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var date = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    return formatStyleFun(year, month, date, hour, minute, second);
}

function formatDate2Date(dateStr, formatStyleFun) {
    var now = new Date(Date.parse(dateStr.replace(/-/g, "/")));
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var date = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    return formatStyleFun(year, month, date, hour, minute, second);
}

// thinkphp的U方法使用js参数
function getJsULink(uLink, paramArr) {
    if (!paramArr) {
        paramArr = {};
    }
    var paramStr = '';
    $.each(paramArr, function (index, value, array) {
        paramStr += '/' + index + '/' + value;
    });

    return uLink + paramStr;
}

function isMobile(v) {
    var cm = "134,135,136,137,138,139,150,151,152,157,158,159,187,188,147,182,183",
        cu = "130,131,132,155,156,185,186,145", ct = "133,153,180,181,189", v = v || "", h1 = v.substring(0, 3),
        h2 = v.substring(0, 4),
        v = (/^1\d{10}$/).test(v) ? (cu.indexOf(h1) >= 0 ? "联通" : (ct.indexOf(h1) >= 0 ? "电信" : (h2 == "1349" ? "电信" : (cm.indexOf(h1) >= 0 ? "移动" : "未知")))) : false;
    return v;
}

function sendAjax(type, url, data, successFun) {
    $.ajax({
        type: type,
        data: data,
        url: url,
        dataType: "json",
        success: successFun
    });
}

// 检查身份证号码是否通过验证
function checkIdNum(pId) {
    //检查身份证号码
    var arrVerifyCode = [1, 0, "x", 9, 8, 7, 6, 5, 4, 3, 2];
    var Wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    var Checker = [1, 9, 8, 7, 6, 5, 4, 3, 2, 1, 1];
    if (pId.length != 15 && pId.length != 18) return {status: false, text: "身份证号共有15位或18位"};
    var Ai = pId.length == 18 ? pId.substring(0, 17) : pId.slice(0, 6) + "19" + pId.slice(6, 16);
    if (!/^\d+$/.test(Ai)) return {status: false, text: "身份证除最后一位外，必须为数字"};
    var yyyy = Ai.slice(6, 10), mm = Ai.slice(10, 12) - 1, dd = Ai.slice(12, 14);
    var d = new Date(yyyy, mm, dd), now = new Date();
    var year = d.getFullYear(), mon = d.getMonth(), day = d.getDate();
    if (year != yyyy || mon != mm || day != dd || d > now || year < 1800) return {status: false, text: "身份证输入错误"};
    for (var i = 0, ret = 0; i < 17; i++) ret += Ai.charAt(i) * Wi[i];
    Ai += arrVerifyCode[ret %= 11];
    return pId.length == 18 && pId != Ai ? {status: false, text: "身份证输入错误"} : {status: true, text: Ai};
};

//根据身份证取 省份,生日，性别
function getIdNumInfo(ic) {
    //获取输入身份证号码
    ic = checkIdNum(ic);
    if (!ic.status) return ic;
    var ic = String(ic.text);
    //获取出生日期
    var birth = ic.substring(6, 10) + "/" + ic.substring(10, 12) + "/" + ic.substring(12, 14);
    console.log('birth:' + birth);
    //获取性别
    var gender = ic.slice(14, 17) % 2 ? "1" : "2"; // 1代表男性，2代表女性
    console.log('sex:' + gender);
    //获取年龄
    var myDate = new Date();
    var month = myDate.getMonth() + 1;
    var day = myDate.getDate();
    var age = myDate.getFullYear() - ic.substring(6, 10) - 1;
    if (ic.substring(10, 12) < month || ic.substring(10, 12) == month && ic.substring(12, 14) <= day) {
        age++;
    }
    var city;
    city = getIdNumCity(ic.substring(0, 2));
    return {'birth': birth, 'gender': gender, 'age': age, 'city': city};
}

function getIdNumCity(idNum) {
    var cityArray = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江",
        31: "上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北",
        43: "湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏",
        61: "陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "新疆",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外"
    };
    return cityArray[idNum];
}

