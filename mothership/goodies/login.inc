<?php	
/*
	Alternative to drupals login block
	Register link before the login form
	password forgotten link is placed after the password field
*/

function mothership_form_user_login_block_alter(&$form, &$form_state, $form_id) {
	//hide the orignal links
	$form['links']['#access'] = FALSE ;

	//register new account link
	$form['info']['#markup'] =  l(t('Register'), 'user/register', array('attributes' => array('class' => 'login-register', 'title' => t('Create a new user account'))));	
	$form['info']['#weight'] = -1;	

	//yum placeholders
  $form['name']['#attributes']['placeholder'] = $form['name']['#title'];
  $form['pass']['#attributes']['placeholder'] = $form['pass']['#title'];
	//password reminder
	$form['pass']['#description'] =  l(t('Forgot password?'), 'user/password', array('attributes' => array('class' => 'login-password', 'title' => t('Get a new password'))));
}	

/*

*/
function mothership_form_user_login_alter(&$form, &$form_state, $form_id) {

  $form['#attributes']['class']= "tooltip";

	$form['name']['#prefix'] =  '<div class="register">' . l(t('Register a new account'), 'user/register', array('attributes' => array('class' => 'login-register', 'title' => t('Create a new user account')))) . '</div>';	
 	$form['pass']['#suffix'] = '<div class="password">' . l(t('Forgot password?'), 'user/password', array('attributes' => array('class' => 'login-password', 'title' => t('Get a new password')))) . '</div>';	
  



}