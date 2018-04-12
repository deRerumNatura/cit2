<section id="form"><!--form-->
	<div class="container">
		<div class="row justify-content-center">
				<div class="col-md-6 login-form"><!--login form-->
					<h2>Sing up your account</h2>
					<form action="<?php echo FULL_PATH?>/login" method="POST">
						<div class="form-group">
							<input required minlength="3" maxlength="30" name="emailOrLogin" type="text" class="form-control"  placeholder="Write your email or login">
						</div>
						<div class="form-group">
							<input required minlength="3" maxlength="30" name="password" type="password" class="form-control" id="login" placeholder="Write your password">
						</div>
						<button type="submit" class="btn btn-outline-primary btn-block btn-lg">Submit</button>
					</form>	
				</div><!--/login form-->
		</div>
	</div>
	</section><!--/form-->