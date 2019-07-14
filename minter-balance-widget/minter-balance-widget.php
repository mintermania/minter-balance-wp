<?php
/*
Plugin Name: Minter balance widget
Plugin URI: https://github.com/mintermania/minter-balance-wp
Description: This plugin adds a widget, that allows you to display amount of any coin on any address. Feel free to support us :) (Mxccf64024facf8c47ddcf47284194b3cbcf5b2a15)
Version: 1.0
Author: MinterMania group
Author URI: https://minterscan.net/address/Mxccf64024facf8c47ddcf47284194b3cbcf5b2a15
License: MIT
*/

// The widget class
class Minter_Balance_Widget extends WP_Widget
{
    
    // Main constructor
    public function __construct()
    {
        parent::__construct('Minter_Balance_Widget', __('Minter Balance Widget', 'text_domain'), array(
            'customize_selective_refresh' => true
        ));
    }
    
    
    public function form($instance)
    {
        
        $defaults = array(
            'title' => '',
            'text' => '',
            'api' => 'https://explorer-api.minter.network/api/v1',
            'coin' => '',
            'show_coin' => '1',
            'address' => '',
            'show_address' => '1',
            'init' => '',
            'update' => '1',
            'show_explorer' => '1',
            'explorer' => ''
        );
        
        // Parse current settings with defaults
        extract(wp_parse_args(( array ) $instance, $defaults));
?>
 
		<?php // Widget Title 
?>
		<p>
			<label for="<?php
        echo esc_attr($this->get_field_id('title'));
?>"><?php
        _e('Widget title', 'text_domain');
?></label>
			<input class="widefat" id="<?php
        echo esc_attr($this->get_field_id('title'));
?>" name="<?php
        echo esc_attr($this->get_field_name('title'));
?>" type="text" value="<?php
        echo esc_attr($title);
?>" />
		</p>
		
		<?php // Description Field 
?>
		<p>
			<label for="<?php
        echo esc_attr($this->get_field_id('text'));
?>"><?php
        _e('Widget description', 'text_domain');
?></label>
			<textarea class="widefat" id="<?php
        echo esc_attr($this->get_field_id('text'));
?>" name="<?php
        echo esc_attr($this->get_field_name('text'));
?>"><?php
        echo wp_kses_post($text);
?></textarea>
		</p>
		
		<?php // api url 
?>
		<p>
			<label for="<?php
        echo esc_attr($this->get_field_id('api'));
?>"><?php
        _e('Explorer API v1 url (i. e. https://explorer-api.minter.network/api/v1) ', 'text_domain');
?></label>
			<input class="widefat" id="<?php
        echo esc_attr($this->get_field_id('api'));
?>" name="<?php
        echo esc_attr($this->get_field_name('api'));
?>" type="text" value="<?php
        echo esc_attr($api);
?>" />
		</p>
		
		<?php // Default coin 
?>
		<p>
			<label for="<?php
        echo esc_attr($this->get_field_id('coin'));
?>"><?php
        _e('Default coin (i. e. HACKER)', 'text_domain');
?></label>
			<input class="widefat" id="<?php
        echo esc_attr($this->get_field_id('coin'));
?>" name="<?php
        echo esc_attr($this->get_field_name('coin'));
?>" type="text" value="<?php
        echo esc_attr($coin);
?>" />
		</p>
		
		<?php // Show coin 
?>
		<p>
			<input id="<?php
        echo esc_attr($this->get_field_id('show_coin'));
?>" name="<?php
        echo esc_attr($this->get_field_name('show_coin'));
?>" type="checkbox" value="1" <?php
        checked('1', $show_coin);
?> />
			<label for="<?php
        echo esc_attr($this->get_field_id('show_coin'));
?>"><?php
        _e('Show coin input field', 'text_domain');
?></label>
		</p>
		
		<?php // Default address 
?>
		<p>
			<label for="<?php
        echo esc_attr($this->get_field_id('address'));
?>"><?php
        _e('Default address (i. e. Mxccf64024facf8c47ddcf47284194b3cbcf5b2a15)', 'text_domain');
?></label>
			<input class="widefat" id="<?php
        echo esc_attr($this->get_field_id('address'));
?>" name="<?php
        echo esc_attr($this->get_field_name('address'));
?>" type="text" value="<?php
        echo esc_attr($address);
?>" />
		</p>
 
 <?php // Show address  
?>
		<p>
			<input id="<?php
        echo esc_attr($this->get_field_id('show_address'));
?>" name="<?php
        echo esc_attr($this->get_field_name('show_address'));
?>" type="checkbox" value="1" <?php
        checked('1', $show_address);
?> />
			<label for="<?php
        echo esc_attr($this->get_field_id('show_address'));
?>"><?php
        _e('Show address input field', 'text_domain');
?></label>
		</p>
 
		<?php // Init 
?>
		<p>
			<input id="<?php
        echo esc_attr($this->get_field_id('init'));
?>" name="<?php
        echo esc_attr($this->get_field_name('init'));
?>" type="checkbox" value="1" <?php
        checked('1', $init);
?> />
			<label for="<?php
        echo esc_attr($this->get_field_id('init'));
?>"><?php
        _e('Auto update when page is loaded (require default values)', 'text_domain');
?></label>
		</p>
		
		<?php // Update 
?>
		<p>
			<input id="<?php
        echo esc_attr($this->get_field_id('update'));
?>" name="<?php
        echo esc_attr($this->get_field_name('update'));
?>" type="checkbox" value="1" <?php
        checked('1', $update);
?> />
			<label for="<?php
        echo esc_attr($this->get_field_id('update'));
?>"><?php
        _e('Auto update every 5 sec', 'text_domain');
?></label>
		</p>
		
		<?php // Show explorer 
?>
		<p>
			<input id="<?php
        echo esc_attr($this->get_field_id('show_explorer'));
?>" name="<?php
        echo esc_attr($this->get_field_name('show_explorer'));
?>" type="checkbox" value="1" <?php
        checked('1', $show_explorer);
?> />
			<label for="<?php
        echo esc_attr($this->get_field_id('show_explorer'));
?>"><?php
        _e('Show link to explorer', 'text_domain');
?></label>
		</p>
 
		<?php // Explorer 
?>
		<p>
			<label for="<?php
        echo $this->get_field_id('explorer');
?>"><?php
        _e('Select explorer', 'text_domain');
?></label>
			<select name="<?php
        echo $this->get_field_name('explorer');
?>" id="<?php
        echo $this->get_field_id('explorer');
?>" class="widefat">
			<?php
        $options = array(
            'main' => __('Default explorer', 'text_domain'),
            'minterscan' => __('Minterscan', 'text_domain')
        );
        
        foreach ($options as $key => $name) {
            echo '<option value="' . esc_attr($key) . '" id="' . esc_attr($key) . '" ' . selected($select, $key, false) . '>' . $name . '</option>';
            
        }
?>
			</select>
		</p>
 
	<?php
    }
    
    
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        
        $instance['title']         = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
        $instance['text']          = isset($new_instance['text']) ? wp_kses_post($new_instance['text']) : '';
        $instance['api']           = isset($new_instance['api']) ? wp_strip_all_tags($new_instance['api']) : '';
        $instance['coin']          = isset($new_instance['coin']) ? wp_strip_all_tags($new_instance['coin']) : '';
        $instance['address']       = isset($new_instance['address']) ? wp_strip_all_tags($new_instance['address']) : '';
        $instance['show_coin']     = isset($new_instance['show_coin']) ? 1 : false;
        $instance['show_address']  = isset($new_instance['show_address']) ? 1 : false;
        $instance['init']          = isset($new_instance['init']) ? 1 : false;
        $instance['update']        = isset($new_instance['update']) ? 1 : false;
        $instance['show_explorer'] = isset($new_instance['show_explorer']) ? 1 : false;
        $instance['explorer']      = isset($new_instance['explorer']) ? wp_strip_all_tags($new_instance['explorer']) : '';
        
        return $instance;
    }
    
    
    public function widget($args, $instance)
    {
        
        extract($args);
        
        
        $title         = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $text          = isset($instance['text']) ? $instance['text'] : '';
        $api           = isset($instance['api']) ? $instance['api'] : 'https://explorer-api.minter.network/api/v1';
        $coin          = isset($instance['coin']) ? $instance['coin'] : '';
        $address       = isset($instance['address']) ? $instance['address'] : '';
        $show_coin     = !empty($instance['show_coin']) ? $instance['show_coin'] : false;
        $show_address  = !empty($instance['show_address']) ? $instance['show_address'] : false;
        $init          = !empty($instance['init']) ? $instance['init'] : false;
        $update        = !empty($instance['update']) ? $instance['update'] : false;
        $show_explorer = !empty($instance['show_explorer']) ? $instance['show_explorer'] : false;
        $explorer      = isset($instance['explorer']) ? $instance['explorer'] : 'main';
        $rand          = rand(0, 999999);
        
        
        echo $before_widget;
        
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';
        
        // Display widget title if defined
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        
        // Display text field
        if ($text) {
            echo '<p>' . $text . '</p>';
        }
        
        
        echo '<p ' . ($show_coin ? '' : 'style="display: none"') . '><label for="' . $rand . '' . esc_attr('coin') . '" >' . ($show_coin ? _e('Coin (i. e. BIP)', 'text_domain') : '') . '</label><input id="' . $rand . '' . esc_attr('coin') . '" type="text" value="' . $coin . '" /></p>';
        
        
        
        echo '<p ' . ($show_address ? '' : 'style="display: none"') . '><label for="' . $rand . '' . esc_attr('address') . '">' . ($show_address ? _e('Address (Mx...)', 'text_domain') : '') . '</label><input id="' . $rand . '' . esc_attr('address') . '" type="text" value="' . $address . '" /></p>';
        
        
        if ($show_address || $show_coin) {
            echo '<p><button onclick="mmget' . $rand . '()">Proceed</button></p>';
        }
        
?>
				<div id="<?php
        echo $rand . esc_attr('result');
?>"></div>
				
				<script>
					var mmfirst<?php
        echo $rand;
?> = true;
					function mmget<?php
        echo $rand;
?>(){
						
						var result = jQuery('#<?php
        echo $rand;
?><?php
        echo esc_attr('result');
?> ');
						var coin = jQuery('#<?php
        echo $rand;
?><?php
        echo esc_attr('coin');
?> ').val();
						var address = jQuery('#<?php
        echo $rand;
?><?php
        echo esc_attr('address');
?> ').val();
						
						if(coin == null || address == null){
							result.html('<p>Error. Check your input</p>');
						} else {
							result.html('<p>Loading...</p>');
							jQuery.get( "<?php
        echo $api;
?>/addresses/"+address, function( data ) {
								
								if(data.data.balances == null){
									result.html('<p>Error. Check your input</p>');
								} else {
									var balance = 0;
									
									data.data.balances.forEach(function(e) {
										if(e.coin == coin){
											balance = e.amount;
										}
});

<?php
        if ($update) {
?>
	if(mmfirst<?php
            echo $rand;
?>){
						window.setInterval(mmget<?php
            echo $rand;
?>, 5000);
}
					<?php
        }
?>
						
						mmfirst<?php
        echo $rand;
?> = false;

									
  result.html('<p>This wallet has '+balance+' '+coin<?php
        echo $show_explorer ? '+\'<br><a href="' . ($explorer == 'main' ? 'https://explorer.minter.network/address' : 'https://minterscan.net/address') . '/\'+address+\'" target="_blank">Explorer</a>' : '+\'';
?></p>');
  }
}).fail(function() {
	result.html('<p>Error. Check your input or network connection</p>');
  });
						}
					}
					<?php
        if ($init && $coin && $address && strlen($coin) > 0 && strlen($address) > 0) {
?>
						document.addEventListener("DOMContentLoaded", mmget<?php
            echo $rand;
?>);
					<?php
        }
?>
					
				</script>
			<?php
        
        echo '</div>';
        
        
        echo $after_widget;
        
    }
    
}


function minter_balance_widget()
{
    register_widget('Minter_Balance_Widget');
}
function my_scripts()
{
    wp_enqueue_script('jquery');
}

add_action(‘init’, ‘my_scripts’);
add_action('widgets_init', 'minter_balance_widget');