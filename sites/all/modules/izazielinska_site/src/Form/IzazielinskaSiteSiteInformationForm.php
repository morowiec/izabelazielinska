<?php

namespace Drupal\izazielinska_site\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\system\Form\SiteInformationForm;
 
/**
 * Configure site information settings for this site.
 */
class IzazielinskaSiteSiteInformationForm extends SiteInformationForm
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state)
	{
		// Retrieve the system.site configuration.
		$site_config = $this->config('system.site');
 
		// Get the original form from the class we are extending.
		$form = parent::buildForm($form, $form_state);
 
		// Add a textfield to the site information section.
		$form['site_information']['site_contact_phone'] = [
		  '#type' => 'textfield',
		  '#title' => t('Contact phone'),
		  '#default_value' => $site_config->get('contact_phone'),
		  '#description' => $this->t('The contact phone of the site'),
		];
		$form['site_information']['site_contact_email'] = [
		  '#type' => 'textfield',
		  '#title' => t('Contact email'),
		  '#default_value' => $site_config->get('contact_email'),
		  '#description' => $this->t('The contact phone of the site'),
		];
 
		return $form;
	}
 
	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state)
	{
		$this->config('system.site')
			->set('contact_phone', $form_state->getValue('site_contact_phone'))
			->set('contact_email', $form_state->getValue('site_contact_email'))
			->save();
		parent::submitForm($form, $form_state);
	}
}
