<?php
/**
 * @file
 * Contains \Drupal\hello_world\Form\HelloForm.
 */
namespace Drupal\hello_world_2\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
 
class HelloForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hello_form';
  }
 
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['full_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Họ Tên:'),
      '#required' => TRUE,
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );
    $form['phone'] = array(
      '#type' => 'number',
      '#title' => t('SDT:'),
      '#required' => TRUE,
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );

    $form['email_address'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email:'),
      '#required' => TRUE,
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );
 
    $form['age'] = array (
      '#type' => 'select',
      '#title' => ('Độ Tuổi'),
      '#options' => array(
        '10' => t('10'),
        '20' => t('20'),
        '30' => t('30'),
        '50' => t('50'),
      ),
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );

    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Mô tả:'),
      '#required' => TRUE,
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );
  
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
            '#prefix'      => '<div class="form-group">',
            '#suffix'      => '</div>',      
    );
    // Disable browser HTML5 validation
    //$form['#attributes']['novalidate'] = 'novalidate';
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
    $conn = Database::getConnection();
    $conn->insert('employee')->fields(
      array(
        'first_name' => $form_state->getValue('first_name'),
        'last_name' => $form_state->getValue('last_name'),
        'email' => $form_state->getValue('email_address'),
        'pincode' => $form_state->getValue('pincode'),
        'role' => $form_state->getValue('employee_role'),
      )
    )->execute();
    */
            drupal_set_message($this->t('Thank you very much @fullname for your message.', [
            '@fullname' => $form_state->getValue('full_name')
        ]));
    //$url = Url::fromRoute('hello.thankyou');
    //$form_state->setRedirectUrl($url);
   }
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
    //$email = $form_state->getValue('email_address');
    $email = $form_state->getValue('email_address');
    $last_part_of_mail = strstr($email, '@');
    $age= (int)$form_state->getValue('age');
    // Assert the firstname is valid
    if ($age <= 18) {
        $form_state->setErrorByName('age', $this->t('Chưa Đủ Độ Tuổi'));
    } 
    if ($last_part_of_mail != '@kyanon.digital') {
     $form_state->setErrorByName('email_address', $this->t('Không đúng email của kyanon'));
    }

  }
}