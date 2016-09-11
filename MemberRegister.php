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
    
    //性别转换为01存储
    if($_POST['memSex'] != '1' || $_POST['memSex'] != '0'){
 //       Header("Location: RegisterFinished.php");
        echo "性别传值错误。";
        $link->close();
        die();
    }
    
    //向会员表中插入内容
    $sql = "INSERT INTO `cnta-member-2016`(`mStuID`, `mName`, `mSex`, `mDepart`, `mQQ`, `mPhone`, `mEmail`) VALUES ('".$_POST['memStuID']."','".$_POST['memName']."','".$sexNum."','".$_POST['memDepart']."','".$_POST['memQQ']."','".$_POST['memPhone']."','".$_POST['memEmail']."')";
    
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
    //此处存疑，具体是关于密码的保存方式以及加密过程。
    $sql = "INSERT INTO `cnta-web-login`(`logEmail`, `logPwd`, `logName`, `logMemID`, `logStuID`, `logPhone`) VALUES ('".$_POST['memEmail']."','".$_POST['memPwd']."','".$_POST['memName']."','".$pass_mID."','".$_POST['memStuID']."','".$_POST['memPhone']."')";
    
    mysqli_query( $link, $sql);

    mysqli_free_result( $res);

    mysqli_close( $link);
    
    echo "恭喜你！计协会员信息注册成功，你现在已经是计协会员了，你可以使用你的邮箱登陆计协网站，默认密码是你的学号。祝你的大学生活快乐，O(∩_∩)O谢谢。";
    
    die();

?>