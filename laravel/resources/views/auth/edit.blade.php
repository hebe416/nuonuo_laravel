@include('layouts.header')
<!-- /. NAV SIDE  -->

<div id="page-wrapper">
    <div class="header">
        <h1 class="page-header">
            Dashboard
            <small>Welcome John Doe</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Data</li>
        </ol>

    </div>
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Basic Form Elements
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form" method="post" action="{{ route('user.update') }}" onsubmit='return checkForm()'>
                                    <input type="hidden" id='id' name='id' value="{{$user->id}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>昵称</label>
                                        <input class="form-control" name="name" id="name" value="{{$user->name}}">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>手机</label>
                                        <input class="form-control" name="mobile" id="mobile" value="{{$user->mobile}}">
                                        <p class="help-block" id='mobile_error' style="font-size:12px;"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>邮箱</label>
                                        <input class="form-control" name="email" id="email" value="{{$user->email}}">
                                        <p class="help-block" id='email_error' style="font-size:12px;"></p>
                                    </div>
                                    <button type="submit" class="btn btn-default">提交</button>
                                    <button type="reset" class="btn btn-default">取消</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /. PAGE INNER  -->
</div>
@include('layouts.footer')
<script>
    $('form').on('keyup', '#mobile', function () {
        if(checkMobile()){
            ajaxCheckMobile();
        }

    });

    $('form').on('keyup', '#email', function () {
        if(checkEmail()){
            ajaxCheckEmail();
        }
    });




    function checkMobile(){
        var mobile = $('#mobile').val();
        var mobile_count = mobile.length;
        if (!(/^1[3|4|5|6|8|9][0-9]\d{8}$/.test(mobile))) {
            $('#mobile_error').css('color','red');
            $('#mobile_error').html('手机号码格式不正确');
            return false;
        } else {
            $('#mobile_error').css('color','green');
            $('#mobile_error').html('');
            return true;
        }
    }

    function checkEmail(){
        var email = $('#email').val();
        if (!(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/).test(email)) {
            $('#email_error').css('color','red');
            $('#email_error').html('邮件格式不正确');
            return false;
        }else{
            $('#email_error').css('color','green');
            $('#email_error').html('');
            return true;
        }
    }

    function checkForm() {

        if (checkMobile() === false)
            return false;
        if(checkEmail() === false)
            return false;

        return true;

    }


    function ajaxCheckMobile(){
        $.ajax({
            url:'/ajax/check',
            type:'post',
            data:{
                'id':$('#id').val(),
                'mobile' : $('#mobile').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success:function(data){
                if(data.code_describe === 'success'){
                    $('#mobile_error').css('color','green');
                    $('#mobile_error').html(data.msg);
                    return true;
                }else{
                    $('#mobile_error').css('color','red');
                    $('#mobile_error').html(data.msg);
                    return false;
                }
            },
            error: function(msg) {
                var json=JSON.parse(msg.responseText);
                if(json.code_describe == 'error'){
                    $('#mobile_error').css('color','red');
                    $('#mobile_error').html(json.msg);
                    return false;
                }

            },
        })

    }


    function ajaxCheckEmail(){
        $.ajax({
            url:'/ajax/check',
            type:'post',
            data:{
                'id':$('#id').val(),
                'email' : $('#email').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success:function(data){

                if(data.code_describe === 'success'){
                    $('#email_error').css('color','green');
                    $('#email_error').html(data.msg);
                    return true;
                }else{
                    $('#email_error').css('color','red');
                    $('#email_error').html(data.msg);
                    return false;
                }
            },
            error: function(msg) {
                var json=JSON.parse(msg.responseText);
                if(json.code_describe == 'error'){
                    $('#email_error').css('color','red');
                    $('#email_error').html(json.msg);
                    return false;
                }

            },
        });

    }







</script>