@extends('login_layout')
@section('content1')

<!--form-->
<section id="form">
		<div class="container" 	
		style=" padding:0px; 
				position:absolute;
				top: 50%;
				left: 50%;
				width:60em;
				height:18em;
				margin-top: -9em; 
				margin-left: -22em;">
			<div class="row">
				<div class="col-sm-4">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Email" />
							<input type="password" name="password_account" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1" >
					<h2 class="or" style="height:250px;width: 10px;padding: 0px;margin: 15px;"></h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Tạo tài khoản mới</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
                            {{csrf_field()}}
							<input type="text" name="ctm_name" placeholder="Tên"/>
							<input type="email" name="ctm_email" placeholder="Email"/>
							<input type="text" name="ctm_phone" placeholder="Số điện thoại"/>
							<input type="password" name="ctm_pw" placeholder="Mật khẩu"/>
							<button type="submit" class="btn btn-default">Tạo tài khoản</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection