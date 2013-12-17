<?php

/**
 * forms actions.
 *
 * @package    rm-market
 * @subpackage forms
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $slug = $request->getParameter('slug');
        $data = $request->getParameter('form');
        $this->form = ServiceFormPeer::retrieveByName($slug);
        $resp = array(
            'f' => false,
            'success' => true,
            'message' => '',
            'close_timeout' => sfConfig::get('app_success_form_timeout'),
            'error_fields' => array()
        );
        if ($this->form instanceof ServiceForm && is_array($data)) {
            $resp['f'] = true;
            $success = true;
            $text = '';
            foreach ($this->form->getOrderedFields() as $field) {
                $goodValue = true;
                $foundValue = true;
                $value = null;
                if ($field->getType() == "radio" || $field->getType() == "checkbox") {
                    if (isset($data[$field->getFieldName()])) {
                        $value = preg_replace("/^[\s]*([\S\s]+?)[\s]*$/", '$1', $data[$field->getFieldName()]);
                        if ($field->getType() == "checkbox") {
                            $value = '+';
                        }
                    } else {
                        if ($field->getType() == "checkbox") {
                            $value = '-';
                        }
                    }
                } else {
                    try {
                        $value = preg_replace("/^[\s]*([\S\s]+?)[\s]*$/", '$1', $data[$field->getFieldName()]);
                    } catch (Exception $exc) {
                        $foundValue = false;
                    }
                }
                if ($field->getIsRequired() && empty($value)) $goodValue = false;
                if (!$goodValue) {
                    $resp['error_fields'][] = $field->getFieldName();
                    $success = false;
                    continue;
                }
                if ($field->getFieldName() == 'email' && $field->getIsRequired()) {
                    $testEmail = Common::translitIt($value);
                    $goodValue = (bool)preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $testEmail);
                    if (!$goodValue) {
                        $resp['error_fields'][] = $field->getFieldName();
                        $success = false;
                    } else {
                        $data['email'] = $value;
                    }
                }
                if ($field->getFieldName() == 'phone') {
                    $testPhone = preg_replace('/[^0-9]/', '', $value);
                    $l = strlen($testPhone);
                    if ($l >= 11 && $l <= 12) {
                        $value = '+'.substr($testPhone, 0, $l-10).' ('.substr($testPhone, $l-10, 3).') '.substr($testPhone, $l-7, 3).'-'.substr($testPhone, $l-4, 2).'-'.substr($testPhone, $l-2, 2);
                        $data['phone'] = $value;
                    } else {
                        $goodValue = false;
                    }
                    if (!$goodValue) {
                        $resp['error_fields'][] = $field->getFieldName();
                        $success = false;
                    }
                }
                
                if ($goodValue) {
                    if ($field->getType() == 'datepicker') {
                        $tryDate = strtotime($value);
                        if ($tryDate) {
                            $value = date("d.m.Y", $tryDate);
                        }
                    }
                    $text .= '<p><b>'.$field->getTitle().':</b><br/>'.nl2br($value).'<p>';
                }
            }
            
            $captchaStored = $this->getUser()->getAttribute(sfConfig::get('app_captcha_session'));
            $captchaRetrieved = $data['chcode'];
            if (!( !empty($captchaRetrieved) && !empty($captchaStored) && strtoupper($captchaRetrieved) == strtoupper($captchaStored)) ) {
                $resp['error_fields'][] = 'chcode';
                $success = false;
            }
            
            $resp['success'] = $success;
            if ($success) {
                $resp['message'] = '<div class="alert alert-warning">'.$this->form->getSuccessMessage().'</div>'.$text;

//                Order form
                if ($this->form->getName() == 'order') {
                    $products = $this->getUser()->getAttribute('cart', array());
                    if (count($products)) {
                        $text .= '<p>Список товара:</p>';
                        $text .= '<table>';
                        $sum = 0;
                        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
                        foreach ($products as $index => $product) {
                            $text .= '<tr>';
                            $text .= '<td width="60%"><a href="'.url_for('zapchasti_label_category_product', array(
                                    'car_label' => $product['label']['slug'],
                                    'category' => $product['category']['slug'],
                                    'product' => $product['product']['slug']
                                )).'" title="'.$product['product']['uid'].'">'.$product['product']['name'].' ('.$product['label']['name'].')</a></td>';
                            $text .= '<td width="16%">'.sprintf('%.2f', $product['product']['distrib_price']).'&nbsp;руб.</td>';
                            $text .= '<td width="8%">x'.$product['amount'].'</td>';
                            $text .= '<td width="16%">'.sprintf('%.2f', $product['product']['distrib_price']*$product['amount']).'&nbsp;руб.</td>';
                            $text .= '</tr>';

                            $sum += $product['product']['distrib_price']*$product['amount'];
                        }
                        $text .= '</table>';
                        $text .= '<p>Сумма: '.sprintf('%.2f', $sum).'р.'.'</p>';
                    } else {
                        $text .= '<p>Список товара пуст!..</p>';
                    }
                    $this->getUser()->getAttributeHolder()->remove('cart');
                }
//                /Order form
                
                $text .= '<p><b>Страница:</b><br/>'.$request->getReferer().'<p>';
                
                $filledForm = new FilledForm();
                $filledForm->setFormId($this->form->getId());
                
                $filledForm->setName($data['name']);
                $filledForm->setEmail($data['email']);
                $filledForm->setPhone($data['phone']);
                $filledForm->setReferer($request->getReferer());
                
                $body = '<html><body>'.$this->form->getOperatorBody()."<br/>\r\n".$text.'</body></html>';
                $message = $this->getMailer()->compose(array(sfConfig::get('app_email_from_no_reply')),
                    $this->form->getOperatorEmail(),
                    $this->form->getOperatorSubject(),
                    $body);
                $message->setContentType("text/html; charset=utf-8");
                $message->setPriority(1);
                $sent = true;
                try {
                    $this->getMailer()->send($message);
                } catch (Exception $exc) {
                    $sent = false;
                }
                $filledForm->setOperatorMailSent($sent);
                
                $sent = false;
                if (!empty($data['email'])) {
                    $sent = true;
                    $body = '<html><body>'.$this->form->getUserBody()."<br/>\r\n".$text.'</body></html>';
                    $message = $this->getMailer()->compose(array(sfConfig::get('app_email_from_no_reply')),
                        $data['email'],
                        $this->form->getUserSubject(),
                        $body);
                    $message->setContentType("text/html; charset=utf-8");
                    try {
                        $this->getMailer()->send($message);
                    } catch (Exception $exc) {
                        $sent = false;
                    }
                }
                $filledForm->setUserMailSent($sent);
                $filledForm->setData(json_encode($data));
                $autoinc = ServiceFormPeer::getAutoincrement($this->form->getId());
                $filledForm->setInnerId($autoinc);
                
                $saved = true;
                try {
                    $filledForm->save();
                } catch (Exception $exc) {
                    $saved = false;
                }
                if ($saved) {
                    $autoinc++;
                    ServiceFormPeer::updateAutoincrement($this->form->getId(), $autoinc);
                }

            }
        }
        return $this->renderText(json_encode($resp));
    }
    
    public function executeShow(sfWebRequest $request) {
        $this->slug = $request->getParameter('slug');
    }
    
    public function executeChcode(sfWebRequest $request) {
        $line = '';
        srand();
        for ($i = 0; $i < sfConfig::get("app_captcha_length"); $i++) {
            $line .= substr(sfConfig::get("app_captcha_chars"), rand(0, strlen(sfConfig::get("app_captcha_chars"))-1), 1);
        }
        $image = new sfImage();
        $image->setMIMEType('image/png');
        $image->create(sfConfig::get("app_captcha_width"), sfConfig::get("app_captcha_height"), sfConfig::get("app_captcha_bg"));
        $image->text($line,
                ceil(sfConfig::get("app_captcha_width")/2 - sfConfig::get("app_captcha_length")/2*sfConfig::get("app_captcha_fontsize")),
                ceil(sfConfig::get("app_captcha_height")/2 - sfConfig::get("app_captcha_fontsize")/3),
                sfConfig::get("app_captcha_fontsize"),
                'courbi', '#000000');
        $this->getUser()->setAttribute(sfConfig::get('app_captcha_session'), $line);
        
        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Cache-Control', 'no-cache, must-revalidate');
        $this->getResponse()->setHttpHeader('Pragma', 'no-cache');
        $this->getResponse()->setHttpHeader('Expires', date("r", time()));
        $this->getResponse()->setStatusCode(200);
        $this->getResponse()->setContentType('image/png');
        $this->getResponse()->sendHttpHeaders();
        ob_end_flush();
        return $this->renderText($image->toString());
    }

}
