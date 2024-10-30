<?php
/**
 * Hello24 Cart view for cart abandonment tabs.
 *
 * @package Hello24-Order-On-Chat-Apps
 */

?>
<div class="wrap">
	<style>
		.h24-input{
			margin-bottom:10px;
			width: 350px;
		}
		.overlay {
			display: none;
			height: 100vh;
			width: 100%;
			position: fixed;
			z-index: 1000000;
			top: 0;
			left: 0;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0, 0.9);
			overflow: hidden;
			transition: 0.5s;
		}
		.overlay-content {
			position: relative;
			top: 40%;
			width: 100%;
			text-align: center;
			display: flex;
			justify-content: center;
		}
		.loader {
			border: 4px solid #ffffff;
			border-top: 4px solid #3498db; /* Blue */
			border-radius: 50%;
			width: 60px;
			height: 60px;
			-webkit-animation: spin 2s linear infinite; /* Safari */
			animation: spin 2s linear infinite;
		}

		.loader-status {
			color: white;
			text-align: center;
			text-decoration: none;
			font-size: 24px;
			display: grid;
		}

		.hello24-grid-container {
			display: grid;
			grid-template-columns: 350px 300px;
			grid-gap: 20px;
		}

		.hello24-grid-container .grid-child img{
			text-align: left;  
		}

		.open_h24_button {
			border-radius: 8px;
			transition-duration: 0.4s;
			background-color: #4CAF50; /* Green */
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}

		.open_h24_button:hover {
			background-color: #FFFFFF; /* Green */
			color: black;
			border: 2px solid #4CAF50;
		}

	</style>
	<div class="loading-content overlay" id="h24_loding">
		<div class="overlay-content">
			<div class="loader"> </div>
			<br/>
			<p class="loader-status"> Please wait..</p>
		</div>
	</div>
	<h1 id="h24_cart_abandonment_tracking_table"><?php echo esc_html__( 'Hello24 - Order on Chat, Abandoned cart recovery & Marketing', 'hello24-order-on-chat-apps' ); ?></h1>
	<h2>Hello24.ai is a conversational commerce platform that can help your brand to engage customers on Chat Apps</h2>
	<h2>Gain higher ROI and 5X sales by using our plugin features.</h2>
	<p>&ensp; 1. Abandoned cart recovery with 'Pay on Chat' feature</p>
	<p>&ensp; 2. Share products and take orders on Chat Apps (complete purchase flow on Chat)</p>
	<p>&ensp; 3. Custom Chatbot Builder</p>
	<p>&ensp; 4. Up-sell, Cross-Sell & Re-sell automation</p>
	<p>&ensp; 5. Order, Shipment notifications to keep your customers well informed about their orders</p>

	<hr>
	<br/>
	<div>
		<input type="submit" id="h24_open_hello24_dashboard" class="open_h24_button" value="Open Hello24 dashboard" />
	</div>
	<br/>
	<hr>
	<br/>
	<h2>Integration Settings</h2>
	<br/>
	<form id="wp_h24_setting_form">
		<div>API Key <span id="api_key_invalid" style="color: red; display:none;">(Invalid API Key)</span></div>
		<input type="text" class="h24-input" disabled id="setting_api_key" value="<?php echo esc_attr($api_key); ?>"/>
		<div>Shop Domain Url</div>
		<input type="text" class="h24-input" disabled id="setting_shop_name" value="<?php echo esc_attr($shop_name); ?>" required/>
		<div>Email</div>
		<input type="email" class="h24-input" id="setting_email" value="<?php echo esc_attr($email); ?>" required/>
		<div>Phone Number (With Country Code. Eg +91 )</div>
		<input type="tel" class="h24-input" id="setting_phone_number" value="<?php echo esc_attr($phone_number); ?>" required/>

		<input type="text" class="h24-input" style="display:none;" disabled id="setting_h24_domain" value="<?php echo esc_attr($h24_domain); ?>" />
		
		<span id="environment_container" style="display:none;">
			<p>Environment:</p>
			<input type="radio" id="environment_prod" name="setting_environment" value="prod" <?php echo esc_attr($environment) == 'prod' ? 'checked' : ''; ?> >
			<label for="environment_prod">Production</label><br>
			<input type="radio" id="environment_dev" name="setting_environment" value="dev" <?php echo esc_attr($environment) == 'dev' ? 'checked' : ''; ?> >
			<label for="environment_dev">Development</label><br>
		</span>

		<br/>
		<div id="h24_enable_integration_note" style="color: red; display:none;">Note: Please fill the above form and click save settings to enable integration with Hello24.</div>
		<br/>
		<div>
			<input type="submit" id="h24_save_settings" class="button-primary" value="Save Settings" />
			<!-- <input type="submit" id="h24_goto_settings" class="button-primary" value="Open Hello24 Dashboard" onclick="window.open('<?php echo esc_url($h24_setting_url); ?>', '_blank')"/> -->
		</div>	
	</form>
	<br/>
	<hr>

	<h2>Chat Button Settings</h2>
	<div class="hello24-grid-container">
		<div class="grid-child">
		<form id="wp_h24_chat_button_form">
			<label for="chat_button_enabled"> Enable Chat Button in your Website ?</label>
			<input type="checkbox" id="chat_button_enabled" name="chat_button_enabled" <?php echo esc_attr($chat_button_enabled) == "enabled" ? 'checked' : ''; ?> />
			<br/>
			<br/>
			<div>Theme Color</div>
			<input type="text" class="h24-input" id="chat_button_theme_color" value="<?php echo esc_attr( $chat_button_theme_color ); ?>"/>
			<div>Theme Color Gradient</div>
			<input type="text" class="h24-input" id="chat_button_theme_color_gradient" value="<?php echo esc_attr( $chat_button_theme_color_gradient ); ?>"/>
			<div>Title</div>
			<input type="text" class="h24-input" id="chat_button_title" value="<?php echo esc_attr($chat_button_title); ?>"/>
			<div>Sub Title</div>
			<input type="text" class="h24-input" id="chat_button_sub_title" value="<?php echo esc_attr($chat_button_sub_title); ?>"/>
			<div>Greeting Text 1</div>
			<input type="text" class="h24-input" id="chat_button_greeting_text1" value="<?php echo esc_attr($chat_button_greeting_text1); ?>"/>
			<div>Greeting Text 2</div>
			<input type="text" class="h24-input" id="chat_button_greeting_text2" value="<?php echo esc_attr($chat_button_greeting_text2); ?>"/>
			<div>Agent Name</div>
			<input type="text" class="h24-input" id="chat_button_agent_name" value="<?php echo esc_attr($chat_button_agent_name); ?>"/>
			<div>Message</div>
			<input type="text" class="h24-input" id="chat_button_message" value="<?php echo esc_attr($chat_button_message); ?>"/>
			<div>Position on Website(left or right)</div>
			<input type="text" class="h24-input" id="chat_button_position" value="<?php echo esc_attr($chat_button_position); ?>"/>
			<div>Position from Bottom(px)</div>
			<input type="text" class="h24-input" id="chat_button_bottom" value="<?php echo esc_attr($chat_button_bottom); ?>"/>
			<br/>

			<div>
				<input type="submit" id="h24_save_chat_button" class="button-primary" value="Save Button" />
			</div>	
		</form>
		</div>

		<div class="grid-child">
			<div>		
				<?php printf(
					'<img src="%1$s" alt="" width="350"/>',
					plugins_url( '../../../../modules/cart-abandonment/assets/img/chat_button.jpg', __FILE__ )
				); ?>
			</div>
		</div>
	
	</div>
</div>
