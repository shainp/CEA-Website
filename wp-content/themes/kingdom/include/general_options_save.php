<?php
require_once('../../../../wp-load.php');
global $wpdb;
foreach ($_REQUEST as $keys=>$values) {
	$$keys = $values;
}
	
	if ( $tab == "color_style" ) {
		$sxe = new SimpleXMLElement("<cs_gs_color_style></cs_gs_color_style>");
			$sxe->addChild('cs_color_scheme', $cs_color_scheme );
			$sxe->addChild('cs_style_sheet', $cs_style_sheet );
		update_option( "cs_gs_color_style", $sxe->asXML() );
		echo "Color and Styles Saved";
	}
	else if ( $tab == "logo" ) {
		$sxe = new SimpleXMLElement("<cs_gs_logo></cs_gs_logo>");
			$sxe->addChild('cs_logo', $cs_logo );
			$sxe->addChild('cs_width', $cs_width );
			$sxe->addChild('cs_height', $cs_height );
		update_option( "cs_gs_logo", $sxe->asXML() );
		echo "Logo Settings Saved";
	}
	else if ( $tab == "header_script" ) {
		$sxe = new SimpleXMLElement("<cs_gs_header_script></cs_gs_header_script>");
			$sxe->addChild('cs_fav_icon', $cs_fav_icon );
			$sxe->addChild('cs_header_code', htmlspecialchars(stripslashes($cs_header_code)) );
			$sxe->addChild('header_phone', htmlspecialchars(stripslashes($header_phone)) );
		update_option( "cs_gs_header_script", $sxe->asXML() );
		echo "Header Script Saved";
	}
	else if ( $tab == "footer_settings" ) {
		$sxe = new SimpleXMLElement("<cs_gs_footer_settings></cs_gs_footer_settings>");
			$sxe->addChild('cs_footer_logo', $cs_footer_logo );
			$sxe->addChild('cs_copyright', htmlspecialchars(stripslashes($cs_copyright)) );
			$sxe->addChild('cs_powered_by', htmlspecialchars(stripslashes($cs_powered_by)) );
			$sxe->addChild('cs_powered_icon', $cs_powered_icon );
			$sxe->addChild('cs_analytics', htmlspecialchars(stripslashes($cs_analytics)) );
		update_option( "cs_gs_footer_settings", $sxe->asXML() );
		echo "Footer Settings Saved";
	}
	else if ( $tab == "captcha" ) {
		$sxe = new SimpleXMLElement("<cs_gs_captcha></cs_gs_captcha>");
			if ( empty($captcha) ) $captcha = '';
				$sxe->addChild('captcha', $captcha );
		update_option( "cs_gs_captcha", $sxe->asXML() );
		echo "Captcha Settings Saved";
	}
	else if ( $tab == "tab_others" ) {
		if ( empty($responsive) ) $responsive = '';
		if ( empty($breadcrumb) ) $breadcrumb = '';
			$sxe = new SimpleXMLElement("<cs_gs_others></cs_gs_others>");
				$sxe->addChild('responsive', $responsive );
				$sxe->addChild('breadcrumb', $breadcrumb );
				update_option( "cs_gs_others", $sxe->asXML() );
				echo "Other Settings Saved";
	}

?>