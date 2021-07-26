<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Cama - Login</title>
<link href="{{ url('css/reset.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/layout.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/themes.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/typography.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/styles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/shCore.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/jquery.jqplot.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/jquery-ui-1.8.18.custom.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/data-table.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/form.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/ui-elements.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/wizard.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/sprite.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('css/gradient.css') }}" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="{{ url('css/ie/ie7.css') }}" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="{{ url('css/ie/ie8.css') }}" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="{{ url('css/ie/ie9.css') }}" />
<![endif]-->
<!-- Jquery -->
<script src="{{ url('js/jquery-1.7.1.min.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.8.18.custom.min.js') }}"></script>
<script src="{{ url('js/jquery.ui.touch-punch.js') }}"></script>
<script src="{{ url('js/chosen.jquery.js') }}"></script>
<script src="{{ url('js/uniform.jquery.js') }}"></script>
<script src="{{ url('js/bootstrap-dropdown.js') }}"></script>
<script src="{{ url('js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ url('js/sticky.full.js') }}"></script>
<script src="{{ url('js/jquery.noty.js') }}"></script>
<script src="{{ url('js/selectToUISlider.jQuery.js') }}"></script>
<script src="{{ url('js/fg.menu.js') }}"></script>
<script src="{{ url('js/jquery.tagsinput.js') }}"></script>
<script src="{{ url('js/jquery.cleditor.js') }}"></script>
<script src="{{ url('js/jquery.tipsy.js') }}"></script>
<script src="{{ url('js/jquery.peity.js') }}"></script>
<script src="{{ url('js/jquery.simplemodal.js') }}"></script>
<script src="{{ url('js/jquery.jBreadCrumb.1.1.js') }}"></script>
<script src="{{ url('js/jquery.colorbox-min.js') }}"></script>
<script src="{{ url('js/jquery.idTabs.min.js') }}"></script>
<script src="{{ url('js/jquery.multiFieldExtender.min.js') }}"></script>
<script src="{{ url('js/jquery.confirm.js') }}"></script>
<script src="{{ url('js/elfinder.min.js') }}"></script>
<script src="{{ url('js/accordion.jquery.js') }}"></script>
<script src="{{ url('js/autogrow.jquery.js') }}"></script>
<script src="{{ url('js/check-all.jquery.js') }}"></script>
<script src="{{ url('js/data-table.jquery.js') }}"></script>
<script src="{{ url('js/ZeroClipboard.js') }}"></script>
<script src="{{ url('js/TableTools.min.js') }}"></script>
<script src="{{ url('js/jeditable.jquery.js') }}"></script>
<script src="{{ url('js/duallist.jquery.js') }}"></script>
<script src="{{ url('js/easing.jquery.js') }}"></script>
<script src="{{ url('js/full-calendar.jquery.js') }}"></script>
<script src="{{ url('js/input-limiter.jquery.js') }}"></script>
<script src="{{ url('js/inputmask.jquery.js') }}"></script>
<script src="{{ url('js/iphone-style-checkbox.jquery.js') }}"></script>
<script src="{{ url('js/meta-data.jquery.js') }}"></script>
<script src="{{ url('js/quicksand.jquery.js') }}"></script>
<script src="{{ url('js/raty.jquery.js') }}"></script>
<script src="{{ url('js/smart-wizard.jquery.js') }}"></script>
<script src="{{ url('js/stepy.jquery.js') }}"></script>
<script src="{{ url('js/treeview.jquery.js') }}"></script>
<script src="{{ url('js/ui-accordion.jquery.js') }}"></script>
<script src="{{ url('js/vaidation.jquery.js') }}"></script>
<script src="{{ url('js/mosaic.1.0.1.min.js') }}"></script>
<script src="{{ url('js/jquery.collapse.js') }}"></script>
<script src="{{ url('js/jquery.cookie.js') }}"></script>
<script src="{{ url('js/jquery.autocomplete.min.js') }}"></script>
<script src="{{ url('js/localdata.js') }}"></script>
<script src="{{ url('js/excanvas.min.js') }}"></script>
<script src="{{ url('js/jquery.jqplot.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.dateAxisRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.cursor.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.logAxisRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.canvasTextRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.highlighter.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.pieRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.barRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.categoryAxisRenderer.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.pointLabels.min.js') }}"></script>
<script src="{{ url('js/chart-plugins/jqplot.meterGaugeRenderer.min.js') }}"></script>
<script src="{{ url('js/custom-scripts.js') }}"></script>
<script src="{{ url('js/common/MD5.js') }}"></script>
<script src="{{ url('js/common/common.js') }}"></script>
<script type="text/javascript">
$(function(){
    $(window).resize(function(){
        $('.login_container').css({
            position:'absolute',
            left: ($(window).width() - $('.login_container').outerWidth())/2,
            top: ($(window).height() - $('.login_container').outerHeight())/2
        });
    });
    // To initially run the function:
    $(window).resize();

        $.ajax({
        type: "OPTIONS",
        url: 'http://172.16.16.37:81/blue/connectors/php/connector.php?cmd=open&target=8ea8853cb93f2f9781e0bf6e857015ea&init=true&tree=true&_=1535393064497',
        async:true,
        dataType : 'json',   //you may use jsonp for cross origin request
        crossDomain:true,
        success: function(data, status, xhr) {
            console.log("data : "+data);
        }
    });
});
</script>
</head>
<body id="theme-default" class="full_block">
    @guest
<div id="login_page">
    
    <div class="login_container">

@if(Session::has('login_error'))

        @if(Session::get('login_error') != '')
        <div class="login_invalid">
            <span class="icon"></span>Invalid Username/Password
        </div>
        {{session(['login_error' => ''])}}
         @endif
 @endif

@if(Session::has('success'))
@if(Session::get('success') != '')
 <div class="login_success">
            <span class="icon"></span>{{Session::get('success')}}
        </div>
        {{session(['success' => ''])}}
         @endif
 @endif      
@if(Session::has('msg_pwd'))
@if(Session::get('msg_pwd') != '')
 <div class="login_success">
            <span class="icon"></span>{{Session::get('msg_pwd')}}
        </div>
        {{session(['msg_pwd' => ''])}}
         @endif
 @endif      



        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="float: right;
    margin-top: 10px;
    margin-right: 10px;">
      <select data-placeholder="Choose a Status..."  style="float: left;" class="cus-select"  id="lang" name="lang" tabindex="6">
                                <option value="ms">Malay</option>                                
                                <option value='en'>English</option>                                
                            </select>
                        </div>
            <div class="login_form">
                <h3 class="blue_d">Login</h3>
                <ul>
                    <li class="login_user">
                    <input id="email" type="text" placeholder="Username" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" name="email" value="{{ old('email') }}" required autofocus>

                         
                    </li>
                    <li class="login_pass">
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    
                    </li>
                </ul>
            </div>


            <button type="submit" class="login_btn blue_lgel">{{ __('Login') }}</button>
            <ul class="login_opt_link">
                <!--<li><a href="#">Forgot Password?</a></li>-->
                <li class="remember_me right">
                 <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</li>
            </ul>
        </form>
    </div>
</div>
@else
    <script type="text/javascript">
        window.location = "dashboard";//here double curly bracket
    </script>
 @endguest
</body>
</html>