<section id="form"><!--form-->
	<div class="container">
		<div class="row justify-content-center">
				<div class="col-md-6 login-form"><!--login form-->
					<h2>Sing up your account</h2>

					<form action="<?php echo FULL_PATH?>/register" method="POST">
						<div class="form-group">
							<label for="email">Email address</label>
							<input required name="email" type="email" class="form-control" id="email" placeholder="Write your email">
						</div>
						<div class="form-group">
							<label for="login">Login</label>
							<input required minlength="3" maxlength="30" name="login" type="text" class="form-control" id="login" placeholder="Write your login">
						</div>
						<div class="form-group">
							<label for="real-name">Real name</label>
							<input required minlength="3" maxlength="30" name="name" type="text" class="form-control" id="real-name" placeholder="Write your real name">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input required minlength="3" maxlength="30" name="password" type="password" class="form-control" id="password" placeholder="Write your password">
						</div>
						<div class="form-group">
							<label for="birth">birth date</label>
							<input required  name="b_date" type="date" class="form-control" id="birth" placeholder="Write your birth date">
						</div>
						<div class="form-group">
							<label for="country">Example select</label>
							<select required name="country_id" class="form-control" id="country">
								<?php foreach($vars['countries'] as $id => $country) :?>
									<?php $id++; ?>
									<option value="<?php echo $id?>"><?php echo $country ?></option>
								<?php endforeach?>
							</select>
						</div>
                        <div class="form-group">
                            <input type="checkbox" name="checkbox"> agree with terms and conditions. <br>
                        </div>
						<button type="submit" class="btn btn-outline-primary btn-block btn-lg">Submit</button>
						</form>	
				</div><!--/login form-->
		</div>
	</div>
	</section><!--/form-->

<!-- <?php if (empty($_SESSION['login'])): ?>
	<form method="post" action="/account/login" >
		<input placeholder="login" type="text" name="login"/>
		<input placeholder="pass" type="text" name="pass" />
		<input type="submit" value="login" name="log_in"/>
	</form>
<?php else: ?>
	<form method="post" action="/account/logout" >
		<input type="submit" name="logout" value="logout">
	</form>
<?php endif ?> -->

