
		<form id="forgot-form" action="forgot-form.php" method="post">
			<fieldset>
				<legend>Forgot Username</legend>
				<label for="email">Email Address</label><br />
				<input name="email" id="email" type="email" /><br />
				<label for="secretquestion">Secret Question</label><br />
				<input name="secretquestion" id="secretquestion" type="secretquestion" /><br />
				<label for="secretanswer">Secret Answer</label><br />
				<input name="secretanswer" id="secretanswer" type="secretanswer" /><br />
				<input type="submit" />
			</fieldset>
			<fieldset>
				<legend>Forgot Password</legend>
				<label for="username">Username</label><br />
				<input name="username" id="username" type="username" /><br />
				<label for="email">Email Address</label><br />
				<input name="email" id="email" type="email" /><br />
				<label for="secretquestion">Secret Question</label><br />
				<select name="secretquestion" id="secretquestion" type="secretquestions">
				<option name="a">Secret Question</option>
				<option value="sq1">What is your mother's maiden name?</option>
				<option value="sq2">What was your first pet?</option>
				<option value="sq3">What was the model of your first car?</option>
				<option value="sq4">In what city were you born?</option>
				</select></br>
				<label for="secretanswer">Secret Answer</label><br />
				<input name="secretanswer" id="secretanswer" type="secretanswer" /><br />
				<input type="submit" />
			</fieldset>
		</form>