<?php

add_action('wpcf7_before_send_mail','dynamic_addcc');

function dynamic_addcc($WPCF7_ContactForm){


    // Formulario Escríbanos
    if (9 == $WPCF7_ContactForm->id()) {

        //Get current form
        $wpcf7      = WPCF7_ContactForm::get_current();

        // get current SUBMISSION instance
        $submission = WPCF7_Submission::get_instance();

        // Ok go forward
        if ($submission) {

            // get submission data
            $data = $submission->get_posted_data();
            if (empty($data)) return;

            $mail = $wpcf7->prop('mail');

            // do some replacements in the cf7 email body
            $contactenos = get_field('contactenos','option');
            foreach ($contactenos as $cc) {
                if($cc['asunto']==$data['Asunto'] && !empty($cc['emails'])){
                    $mail['additional_headers'] = "Cc: ".$cc['emails'];
                }
            }

            // Save the email body
            $wpcf7->set_properties(array(
                "mail" => $mail
            ));

            // return current cf7 instance
            return $wpcf7;
        }
    }

/*
    // Formulario Cotizaciones
    if (2012 == $WPCF7_ContactForm->id()) {

        //Get current form
        $wpcf7      = WPCF7_ContactForm::get_current();

        // get current SUBMISSION instance
        $submission = WPCF7_Submission::get_instance();

        // Ok go forward
        if ($submission) {

            // get submission data
            $data = $submission->get_posted_data();
            if (empty($data)) return;

            $mail = $wpcf7->prop('mail');

            // do some replacements in the cf7 email body
        	$pcf = get_post($data['Modalidad']);
            if (! $pcf) return;
            
			switch ($pcf->post_name) {
				case 'nuevos':
					$cc = get_field('cc_productos_nuevos','option');
					break;
				case 'usados':
					$cc = get_field('cc_productos_usados','option');
					break;
				case 'alquiler':
					$cc = get_field('cc_productos_alquiler','option');
					break;
				case 'promociones':
					$cc = get_field('cc_promociones','option');
					break;
				default:
					$cc = null;
					break;
			}

            if(!empty($cc)){
                $mail['additional_headers'] = "Cc: $cc";
            }

            // Save the email body
            $wpcf7->set_properties(array(
                "mail" => $mail
            ));

            // return current cf7 instance
            return $wpcf7;
        }
    }
*/
}
