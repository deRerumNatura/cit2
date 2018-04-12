<section id="form"><!--form-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-form"><!--login form-->
                <h2>Sing up your account</h2>

                <!-- ////////////////////////////////////////////////////// -->
                <?php if(!empty($vars['reg_errors'])): ?>
                    <div style="background: pink">
                        <?php foreach($vars['reg_errors'] as $erroor) :?>
                            <p><?php echo $erroor; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <!-- ////////////////////////////////////////////////////// -->

                <form action="<?php echo FULL_PATH?>/register" method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input required name="email" value="<?php echo ( isset($_SESSION['f_email']) ) ? $_SESSION['f_email']: '';?>" type="email" class="form-control" id="email" placeholder="Write your email">
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input required minlength="3" maxlength="30" name="login" value="<?php echo ( isset($_SESSION['f_login']) ) ? $_SESSION['f_login']: '';?>" type="text" class="form-control" id="login" placeholder="Write your login">
                    </div>
                    <div class="form-group">
                        <label for="real-name">Real name</label>
                        <input required minlength="3" maxlength="30" name="name" value="<?php echo ( isset($_SESSION['f_name']) ) ? $_SESSION['f_name']: '';?>" type="text" class="form-control" id="real-name" placeholder="Write your real name">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input required minlength="3" maxlength="30" name="password" value="<?php echo ( isset($_SESSION['f_password']) ) ? $_SESSION['f_password']: '';?>" type="password" class="form-control" id="password" placeholder="Write your password">
                    </div>
                    <div class="form-group">
                        <label for="birth">birth date</label>
                        <input required name="b_date" value="<?php echo ( isset($_SESSION['f_b_date']) ) ? $_SESSION['f_b_date']: '';?>" type="date" class="form-control" id="birth" placeholder="Write your birth date">
                    </div>
                    <div class="form-group">
                        <label for="country">Example select</label>
                        <select required id="my_select" name="country_id" class="form-control" id="country">

                            <?php foreach($vars['countries'] as $id => $country) :?>
                                <?php $id++; ?>
                                <?if (isset($_SESSION['f_country_id']) && $id == $_SESSION['f_country_id']):?>
                                    <option  value="<?php echo $id?>" selected><?php echo $country ?></option>
                                <?else :?>
                                    <option value="<?php echo $id?>"><?php echo $country ?></option>
                                <?endif;?>
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



