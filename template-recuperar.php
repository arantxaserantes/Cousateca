<?php
/*
Template Name: Recuperar contrasinal
*/



get_header();
if (isset($_GET['deleted'])) { ?>
<div id="mensaxe_consola" class="visible"><div class="contido_consola">A cousa foi eliminada</div><button type="button"><i class="material-icons">close</i></button></div>
<?php } ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6">

			<div id="login-register-password">

				<?php global $user_ID, $user_identity; ?>

				<div class="tab_container_login">
					<div id="tab3_login" class="tab_content_login">
						<h3>Lose something?</h3>
						<p>Enter your username or email to reset your password.</p>
						<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
							<div class="username">
								<label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
								<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
							</div>
							<div class="login_fields">
								<?php do_action('login_form', 'resetpass'); ?>
								<input type="submit" name="user-submit" value="<?php _e('Reset my password'); ?>" class="user-submit" tabindex="1002" />
								<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
								<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
								<input type="hidden" name="user-cookie" value="1" />
							</div>
						</form>
					</div>
				</div>



			</div>		</div>
	</div>
</div>

<?php
get_footer();
