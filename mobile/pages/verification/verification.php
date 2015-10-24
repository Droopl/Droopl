<article class="verification">
	 <div class="register-box animated fadeInUp">
	 	<div class="container">
	 		<?php if(!$verificationSent && !$verified){ ?>
	 		<header>
	 			<h1>Haven't recieved your code ? Resend your code </h1>
	 			<h2>Please check your junkmail if you can't find you mail</h2>

	 			<nav>
	 				<?php if(isset($_SESSION['user'])){ ?>
	 				<a href="?page=verification&action=resend">Resend <span> to <?php echo $_SESSION['user']['email']; ?></span></a>
	 				<?php }else{ ?>
	 				<a href="?page=login">Login in verify your account<?php ?></a>
	 				<?php } ?>
	 			</nav>
	 		</header>
	 		<?php }else if($verificationSent && !$verified){ ?>
	 		<header>
	 			<span class="icon-circle-check"></span>
	 			<h1>Your verification code has been sent </h1>
	 			<h2>Please check your junkmail if you can't find you mail</h2>
	 		</header>
	 		<?php } ?>
		<section class="step_3">
		    <aside class="left">
		    	<?php if(!$verified){ ?>
		        <form action="?page=verification" id="validation_form" name="validation_form" method="post">
		            <h1>Verify your account</h1>
		            <p>Insert the 4-digit code we just sent you by email to validate your account</p>
		            <span class="icon-unlock"></span>
		            <ul class="code-ul">
		                <li>
		                    <input type="text" id="digit_1" name="digit_1" maxlength="1" required>
		                </li>
		                <li>
		                    <input type="text" id="digit_2" name="digit_2" maxlength="1" required>
		                </li>
		                <li>
		                    <input type="text" id="digit_3" name="digit_3" maxlength="1" required>
		                </li>
		                <li>
		                    <input type="text" id="digit_4" name="digit_4" maxlength="1" required>
		                </li>
		            </ul>
		            <input type="submit" id="submit_step_3" name="submit_step_3" value="Validate">
		        </form>
		        <?php }else{?>

		        <p> Your account has been verified !</p>

		        <?php } ?>
		    </aside>
		</section>
	</div>
	</div>
</article>