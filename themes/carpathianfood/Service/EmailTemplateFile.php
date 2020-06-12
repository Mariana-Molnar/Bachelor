<?php
/**
 * Created by PhpStorm.
 * User: Przemek
 * Date: 2017-03-11
 * Time: 11:39
 */

namespace Service;


class EmailTemplateFile extends File {

	public function __construct($template_name) {

		if (end(explode('.', $template_name)) !== 'php') $template_name .= '.php';

		$email_templates_dir = '/template-parts/emails/';
		$file = locate_template($email_templates_dir . $template_name);
		parent::__construct($file);
	}
}