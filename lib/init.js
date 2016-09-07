jQuery(document).ready(function($) {
	// 在键盘按下并释放及提交后验证提交表单
	 jQuery.validator.addMethod("regex",  //addMethod第1个参数:方法名称
        function(value, element, params) {     //addMethod第2个参数:验证方法，参数（被验证元素的值，被验证元素，参数）
            var exp = new RegExp(params);     //实例化正则对象，参数为传入的正则表达式
            return exp.test(value);                    //测试是否匹配
        },

  $("#signupForm").validate({
    rules: {
      memName: {
        required: true,
        minlength: 2
      },
      memSex: {
        required: false,
        minlength: 1
      },
      memStuID: {
        required: true,
        minlength: 12,
      },
      memDepart: {
        required: true,
      },
      memQQ: {
        minlength: 6,
        regex:"/^[1-9]\d{4,9}$/"
      },
      memPhone: {
      	required:true,
      	minlength:11,
      	regex:"/^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/"
      },
      memEmail: {
        minlength: 2,
        email: true,
        regex:"/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/"
      },
    },
    messages: {
    	memName: {
        required: "请输入姓名",
      },
      memName: {
        required: "请输入学号",
      },
      memStuID: {
      	minlength:"请输入一个正确的学号"
      },
      memDepart: {
        required: "请输入院系",
      },
      memQQ: {
      	required:"请输入QQ",
        minlength:"请输入一个正确的QQ"
      },
      memPhone: {
      	required:"请输入手机号",
        minlength:"请输入一个正确的手机号"
      },
      memEmail: "请输入一个正确的邮箱",
    },
    debug: false,  //如果修改为true则表单不会提交
    submitHandler: function() {
    alert("感谢注册");}
	}));
})