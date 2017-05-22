<?php 

class ContactPage extends Page {
    
}

class ContactPage_Controller extends Page_Controller {
    
    private static $allowed_actions = array(
        'ContactForm'
    );
    
    public function ContactForm() {
        $form = Form::create(
            $this,
            __FUNCTION__,
            FieldList::create(
                EmailField::create('Email', 'Email:'),
                TextField::create('Name', 'Name:'),
                TextField::create('Company', 'Company (optional)'),
                TextareaField::create('Message', 'Message:'),
                new RecaptchaField('MyCaptcha')
            ),
            FieldList::create(
                FormAction::create('handleContact', 'Submit')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-primary btn-lg')
            ),
            RequiredFields::create('Email', 'Name', 'Message')
        );
        
        foreach($form->Fields() as $field) {
            $field->setAttribute('class', 'form-control')
                ->addExtraClass('form-group');
        }
        
        return $form;
    }
    
    public function handleContact($data, $form) {
        
        $email = new Email();
        $email
            ->setFrom($data['Email'])
            ->setTo(SiteConfig::current_site_config()->MainEmail)
            ->setSubject('Contact from site')
            ->setTemplate('ContactEmail')
            ->populateTemplate(new ArrayData(array(
                'Name' => $data['Name'],
                'Email' => $data['Email'],
                'Company' => $data['Company'],
                'Message' => $data['Message']
            )));
        
        $email->send();
        
        $form->sessionMessage('Thank you for contacting me', 'good');
        return $this->redirectBack();
    }
    
}

?>