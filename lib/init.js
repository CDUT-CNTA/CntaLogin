jQuery(document).ready(function($) {
  
  $("#fSubmit").click(function(event) {
    /* Act on the event */
    event.preventDefault();
    var shaPhone = hex_sha1($("#memPhone").val());

    $("#memPwd").val(shaPhone);

    if (!$("#signupForm").valid()) {
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "MemberRegister.php",
        //?time=" + (new Date()).getTime(),
        data: $("#signupForm").serialize(),
        dataType: "html",
        cache: false,
        success: function(msg) {
          alert(msg);
          window.location.reload();
        },
        error: function() {
          alert("error");
        }
      });
    }

    event.stopPropagation();
  });


  //设置默认属性
  $.validator.setDefaults({
    submitHandler: function(form) {
      form.submit();
    }
  });

  // 字符验证
  jQuery.validator.addMethod("stringCheck", function(value, element) {
    return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
  }, "只能包括中文字、英文字母、数字和下划线");

  // 中文字两个字节
  jQuery.validator.addMethod("byteRangeLength", function(value, element, param) {
    var length = value.length;
    for (var i = 0; i < value.length; i++) {
      if (value.charCodeAt(i) > 127) {
        length++;
      }
    }
    return this.optional(element) || (length >= param[0] && length <= param[1]);
  }, "请确保输入的值在3-15个字节之间(一个中文字算2个字节)");

  // 身份证号码验证
  jQuery.validator.addMethod("isIdCardNo", function(value, element) {
    return this.optional(element) || isIdCardNo(value);
  }, "请正确输入您的身份证号码");

  // 联系电话(手机/电话皆可)验证
  jQuery.validator.addMethod("isPhone", function(value, element) {
    var length = value.length;
    var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;
    var tel = /^\d{3,4}-?\d{7,9}$/;
    return this.optional(element) || (tel.test(value) || mobile.test(value));

  }, "请正确填写您的联系电话");

  //QQ验证
  jQuery.validator.addMethod("isQQ", function(value, element) {
    var tel = /^[1-9]\d{4,9}$/;
    return this.optional(element) || (tel.test(value));
  }, "qq号码格式错误");


  //开始验证
  $('#signupForm').validate({
    /* 设置验证规则 */
    rules: {
      memName: {
        required: true,
        stringCheck: true,
        byteRangeLength: [3, 15]
      },
      memStuID: {
        required: true,
        byteRangeLength: [12, 13]
      },
      memDepart: {
        required: true,
      },
      memQQ: {
        required: true,
        isQQ: true
      },
      memPhone: {
        required: true,
        isPhone: true
      },
      memEmail: {
        required: true,
        email: true
      }
    },

    /* 设置错误信息 */
    messages: {
      memName: {
        required: "请填写用户名",
        stringCheck: "用户名只能包括中文字、英文字母、数字和下划线",
        byteRangeLength: "用户名必须在3-15个字符之间(一个中文字算2个字符)"
      },
      memStuID: {
        required: "请填写学号",
        byteRangeLength: "学号长度只能为12到13位"
      },
      memDepart: {
        required: "请填写院系"
      },
      memQQ: {
        required: "请填写QQ",
        isQQ: "请输入一个有效的QQ"
      },
      memPhone: {
        required: "请输入您的联系电话",
        isPhone: "请输入一个有效的联系电话"
      },
      memEmail: {
        required: "请输入一个Email地址",
        email: "请输入一个有效的Email地址"
      }
    },

    /* 设置验证触发事件 */
    focusInvalid: true,

    /* 设置错误信息提示DOM */
    errorPlacement: function(error, element) {
      error.appendTo(element.parent());
    },

  });
});