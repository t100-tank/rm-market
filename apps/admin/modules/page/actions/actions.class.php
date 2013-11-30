<?php

require_once dirname(__FILE__).'/../lib/pageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pageGeneratorHelper.class.php';

/**
 * page actions.
 *
 * @package    rm-market
 * @subpackage page
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class pageActions extends autoPageActions {
    
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('pages')) {
            $this->redirect('@homepage');
        }
    }
    
    public function executeImport(sfWebRequest $request) {
    }
    public function executeImportStore(sfWebRequest $request) {
        $csv = $request->getFiles('csv');
        if ($csv['error'] != 0) {
            $this->getUser()->setFlash('error', 'Ошибка загрузки файла');
        } else {
            $result = PagesPeer::import($csv['tmp_name'], $request->getParameter('encoding'));
            if ($result['success']) {
                $this->getUser()->setFlash('notice', 'Файл обработан без ошибок. Было сохранено '.$result['worked']." строк(а).");
            } else {
                $this->getUser()->setFlash('error', 'В ходе импорта произошли ошибки. Было сохранено '.$result['worked']." строк. Проблемными были строки(а): ".implode(', ', $result['errorLines']));
            }
        }
        $this->redirect($request->getReferer());
    }
    
    public function executeExport(sfWebRequest $request) {
    }
    public function executeExportEncoding(sfWebRequest $request) {
        $file = PagesPeer::dumpExport($this->getUser()->getGuardUser()->getId(), $request->getParameter('encoding'));
        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setStatusCode(200);
        $this->getResponse()->setContentType('application/csv');
        $this->getResponse()->setHttpHeader('Pragma', 'public'); //optional cache header
        $this->getResponse()->setHttpHeader('Expires', 0); //optional cache header
        $this->getResponse()->setHttpHeader('Content-Disposition', "attachment; filename=".basename($file));
        $this->getResponse()->setHttpHeader('Content-Transfer-Encoding', 'binary');
        $this->getResponse()->setHttpHeader('Content-Length', filesize($file));
        $this->getResponse()->sendHttpHeaders();
        ob_end_flush();
        return $this->renderText(readfile($file));
    }
}
