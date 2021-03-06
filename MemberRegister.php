<?php
    //引用数据库信息文件
    require_once 'DataBaseInfo.php';
    
    header("Content-type: text/html; charset=utf-8"); 

    //【会员信息注册】
    //传递变量如下：
    //学号    memStuID
    //姓名    memName
    //性别    memSex  
    //院系    memDepart
    //QQ      memQQ
    //手机号码    memPhone
    //电子邮箱    memEmail
    //加密密码    memPwd
    //其中会员的登陆密码默认为学号，登陆昵称默认为真实姓名

    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    if( !$link ){
        die("连接数据库失败</br>".mysqli_connect_error($link));
    }

    //学号查重判断
    $sql = "SELECT `mID` FROM `cnta-member-2016` WHERE `mStuID` = '".$_POST['memStuID']."'";

    if( !($res = mysqli_query( $link, $sql)) ){
        echo "数据库查询失败，请重试。";
        $link->close();
        die();
    }
        
    $check_StuID_repeat = mysqli_fetch_assoc( $res);

    if($check_StuID_repeat['mID']){
        echo "该学号已注册，请勿重复注册。";
        $link->close();
        die();
    }

    //手机号查重判断
    $sql = "SELECT `mID` FROM `cnta-member-2016` WHERE `mPhone` = '".$_POST['memPhone']."'";

    if( !($res = mysqli_query( $link, $sql)) ){
        echo "数据库查询失败，请重试。";
        $link->close();
        die();
    }
        
    $check_Phone_repeat = mysqli_fetch_assoc( $res);

    if($check_Phone_repeat['mID']){
        echo "该手机号已注册，请勿重复注册。";
        $link->close();
        die();
    }

    //邮箱查重判断
    $sql = "SELECT `mID` FROM `cnta-member-2016` WHERE `mEmail` = '".$_POST['memEmail']."'";

    if( !($res = mysqli_query( $link, $sql)) ){
        echo "数据库查询失败，请重试。";
        $link->close();
        die();
    }
        
    $check_Email_repeat = mysqli_fetch_assoc( $res);

    if($check_Email_repeat['mID']){
        echo "该邮箱已注册，请勿重复注册。";
        $link->close();
        die();
    }

    // 性别判断
    if ( $_POST['memSex'] == '1' || $_POST['memSex'] == '0'){
    //向会员表中插入内容
    $sql = "INSERT INTO `cnta-member-2016`(`mStuID`, `mName`, `mSex`, `mDepart`, `mQQ`, `mPhone`, `mEmail`) VALUES ('".$_POST['memStuID']."','".$_POST['memName']."','".$_POST['memSex']."','".$_POST['memDepart']."','".$_POST['memQQ']."','".$_POST['memPhone']."','".$_POST['memEmail']."')";
    } else{
        echo "性别传值错误。";
        $link->close();
        die();
    }
    
    if ( !( $res = mysqli_query( $link, $sql)) ){
        echo "数据库操作失败，请重试。";
        $link->close();
        die();
    }
    
    //查询会员表中主键mID，传给网站信息表
    $sql = "SELECT `mID` FROM `cnta-member-2016` WHERE `mStuID` = '".$_POST['memStuID']."'";

    if ( !( $res = mysqli_query( $link, $sql)) ){
        echo "数据库操作失败，请重试。";
        $link->close();
        die();
    }

    $row = mysqli_fetch_assoc( $res);
    
    $pass_mID = $row['mID'];

    //向网站信息表中插入内容
    $sql = "INSERT INTO `cnta-web-login`(`logEmail`, `logPwd`, `logName`, `logMemID`, `logStuID`, `logPhone`, `emailConfirm`) VALUES ('".$_POST['memEmail']."','".$_POST['memPwd']."','".$_POST['memName']."','".$pass_mID."','".$_POST['memStuID']."','".$_POST['memPhone']."','0')";
    
    mysqli_query( $link, $sql);

    mysqli_free_result( $res);

    mysqli_close( $link);
    
    echo "恭喜你！计协会员信息注册成功~"."\n"."现在你可以使用你的邮箱登陆计协网站，默认密码是你的手机号码。"."\n"."祝你的大学生活快乐，O(∩_∩)O谢谢。";
    
    die();

?>